<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FirmwareCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:firmware';

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
            [
                'Accept-Language' => 'en-US',
                'Token' => $this->getCurrentToken($input),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query(['sn' => $input->getArgument('serialNumber')]),
        );

        $response = $this->getClient()->send($request);

        var_dump($response->getHeaders());

        $result = json_decode($response->getBody()->getContents());

        var_dump($result);

        $output->writeln('TBD');

        return 1;
    }
}
