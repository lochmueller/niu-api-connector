<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BatteryCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:battery';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get battery information');
        $this->addArgument('serialNumber', InputOption::VALUE_REQUIRED, 'Your serial number of your vehicle');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $request = new Request(
            'GET',
            'https://app-api-fk.niu.com/v3/motor_data/battery_info?sn='.$input->getArgument('serialNumber'),
            [
                'Accept-Language' => 'en-US',
                'Token' => $this->getCurrentToken($input),
            ]
        );

        $response = $this->getClient()->send($request);

        $result = json_decode($response->getBody()->getContents());

        var_dump($result);

        $output->writeln('TBD');

        return self::SUCCESS;
    }
}
