<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'niu:overall-tally')]
class OverallTallyCommand extends AbstractNiuCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get overall tally information');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('no implemented yet');

        return self::SUCCESS;
    }
}
