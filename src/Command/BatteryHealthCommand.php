<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BatteryHealthCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:battery-health';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get battery health information');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('TBD');

        return 1;
    }
}
