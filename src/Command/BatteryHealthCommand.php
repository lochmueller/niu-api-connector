<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'niu:battery-health')]
class BatteryHealthCommand extends AbstractNiuCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get battery health information');
        $this->addArgument('serialNumber', InputOption::VALUE_REQUIRED, 'Your serial number of your vehicle');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $request = new Request(
            'GET',
            'https://app-api-fk.niu.com/v3/motor_data/battery_info/health?sn='.$input->getArgument('serialNumber'),
            array_merge($this->getDefaultHeaders(), [
                'Token' => $this->getCurrentToken($input)
            ]),
        );

        $response = $this->getClient()->send($request);

        $result = json_decode($response->getBody()->getContents());

        $formatter = $this->getFormatter($input);
        if (!isset($result->data)) {
            $formatter->output($output, [['status' => 'error', 'message' => 'No battery health infos found']]);

            return self::FAILURE;
        }

        $formatter->output($output, [$this->flattenArray([$result->data])]);

        return self::SUCCESS;
    }
}
