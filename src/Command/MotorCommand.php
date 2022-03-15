<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MotorCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:motor';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get motor information');
        $this->addArgument('serialNumber', InputOption::VALUE_REQUIRED, 'Your serial number of your vehicle');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $request = new Request(
            'GET',
            'https://app-api-fk.niu.com/v3/motor_data/index_info?sn='.$input->getArgument('serialNumber'),
            [
                'Accept-Language' => 'en-US',
                'Token' => $this->getCurrentToken($input),
            ]
        );

        $response = $this->getClient()->send($request);

        $result = json_decode($response->getBody()->getContents());

        $formatter = $this->getFormatter($input);
        if (!isset($result->data)) {
            $formatter->output($output, [['status' => 'error', 'message' => 'No motor infos found']]);

            return self::FAILURE;
        }

        $data = (array) $result->data;
        if (isset($data['batteries']->compartmentA->batteryCharging, $data['batteries']->compartmentB->batteryCharging)) {
            $data['totalBatteryCharging'] = ($data['batteries']->compartmentA->batteryCharging + $data['batteries']->compartmentB->batteryCharging) / 2;
        }

        $formatter->output($output, [$this->flattenArray($data)]);

        return self::SUCCESS;
    }
}
