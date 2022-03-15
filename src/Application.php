<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector;

use Lochmueller\NiuApiConnector\Command\AuthenticationCommand;
use Lochmueller\NiuApiConnector\Command\BatteryCommand;
use Lochmueller\NiuApiConnector\Command\BatteryHealthCommand;
use Lochmueller\NiuApiConnector\Command\FirmwareCommand;
use Lochmueller\NiuApiConnector\Command\MotorCommand;
use Lochmueller\NiuApiConnector\Command\OverallTallyCommand;
use Lochmueller\NiuApiConnector\Command\TracksCommand;
use Lochmueller\NiuApiConnector\Command\VehiclesCommand;
use Symfony\Component\Console\Application as ConsoleApplication;

class Application
{
    public function __invoke(): void
    {
        $application = new ConsoleApplication();
        $application->add(new AuthenticationCommand());
        $application->add(new BatteryCommand());
        $application->add(new BatteryHealthCommand());
        $application->add(new FirmwareCommand());
        $application->add(new MotorCommand());
        $application->add(new OverallTallyCommand());
        $application->add(new TracksCommand());
        $application->add(new VehiclesCommand());
        $application->run();
    }
}
