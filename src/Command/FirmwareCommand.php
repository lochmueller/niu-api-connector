<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FirmwareCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:firmware';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get firmware information');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('TBD');

        return 1;
    }
}
