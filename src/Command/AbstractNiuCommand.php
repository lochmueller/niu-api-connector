<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

abstract class AbstractNiuCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption('format', 'f', InputOption::VALUE_REQUIRED, 'Output format');
    }
}
