<?php

namespace Lochmueller\NiuApiConnector\Command;

use Lochmueller\NiuApiConnector\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OverallTallyCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:overall-tally';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get overall tally information');
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        $output->writeln('TBD');
        return 1;
    }
}
