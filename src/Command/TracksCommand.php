<?php

namespace Lochmueller\NiuApiConnector\Command;

use Lochmueller\NiuApiConnector\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TracksCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:tracks';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get track information');
        $this->addOption('track', 't', InputOption::VALUE_REQUIRED, 'Track ID for more details');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('TBD');
        return 1;
    }
}