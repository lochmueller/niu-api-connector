<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'niu:firmware')]
class FirmwareCommand extends AbstractNiuCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get firmware information');
        $this->addArgument('serialNumber', InputOption::VALUE_REQUIRED, 'Your serial number of your vehicle');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $request = new Request(
            'POST',
            'https://app-api-fk.niu.com/motorota/getfirmwareversion',
            array_merge($this->getDefaultHeaders(), [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Token' => $this->getCurrentToken($input)
            ]),
            http_build_query(['sn' => $input->getArgument('serialNumber')]),
        );

        $response = $this->getClient()->send($request);

        $result = json_decode($response->getBody()->getContents());

        $formatter = $this->getFormatter($input);
        if (!isset($result->data)) {
            $formatter->output($output, [['status' => 'error', 'message' => 'No firmware infos found']]);

            return self::FAILURE;
        }

        $formatter->output($output, [(array) $result->data]);

        return self::SUCCESS;
    }
}
