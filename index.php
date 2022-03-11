#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new \Lochmueller\NiuApiConnector\Command\AuthenticationCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\BatteryCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\BatteryHealthCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\FirmwareCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\MotorCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\OverallTallyCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\TracksCommand());
$application->add(new \Lochmueller\NiuApiConnector\Command\VehiclesCommand());
$application->run();
