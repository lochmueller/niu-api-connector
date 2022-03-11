<?php

namespace Lochmueller\NiuApiConnector\Command;

use Lochmueller\NiuApiConnector\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AuthenticationCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:authentication';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Authentication against the NIU API');

        $this->addOption('email', 'e', InputOption::VALUE_REQUIRED, 'Your account email address');
        $this->addOption('password', 'p', InputOption::VALUE_REQUIRED, 'Your account password. It is recommended to store this in the .env file or _ENV in general!!');
        $this->addOption('countryCode', 'c', InputOption::VALUE_REQUIRED, 'Your country code');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        #$configuration = (new Configuration())->get();
        $output->writeln('Hello World');
        return 1;
    }
}
