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

        $formatter = $this->getFormatter($input);
        if (!isset($result->data)) {
            $formatter->output($output, [['status' => 'error', 'message' => 'No firmware infos found']]);

            return self::FAILURE;
        }

        $data = (array) $result->data;

        if (!isset($data['batteries'])) {
            return self::FAILURE;
        }
        if (isset($data['batteries']->compartmentA->items)) {
            unset($data['batteries']->compartmentA->items);
        }
        if (isset($data['batteries']->compartmentB->items)) {
            unset($data['batteries']->compartmentB->items);
        }

        $batteries = [];
        foreach ((array) $data['batteries'] as $battery) {
            $battery = (array) $battery;
            if (isset($battery['items'])) {
                unset($battery['items']);
            }

            ksort($battery);
            $battery['isCharging'] = null;
            $battery['estimatedMileage'] = null;
            $batteries[] = $battery;
        }

        $meta = array_combine(array_keys($batteries[0]), [null, null, null, null, null, null, null, null, null, null, null]);
        $meta['isCharging'] = $data['isCharging'];
        $meta['estimatedMileage'] = $data['estimatedMileage'];

        $batteries[] = $meta;

        $formatter->output($output, $batteries);

        return self::SUCCESS;
    }
}
