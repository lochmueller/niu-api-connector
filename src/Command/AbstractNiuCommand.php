<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use Lochmueller\NiuApiConnector\Client;
use Lochmueller\NiuApiConnector\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

abstract class AbstractNiuCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption('format', 'f', InputOption::VALUE_REQUIRED, 'Output format');
        $this->addOption('tokenFile', 'to', InputOption::VALUE_REQUIRED, 'Token file for auth token. Default is "./auth.token"', './auth.token');
    }

    protected function getTokenFile(InputInterface $input): string
    {
        return $this->getOptionInclFallback($input, 'tokenFile', 'NIU_TOKEN_FILE');
    }

    protected function getCurrentToken(InputInterface $input): ?string
    {
        return is_file($this->getTokenFile($input)) ? file_get_contents($this->getTokenFile($input)) : null;
    }

    protected function getOptionInclFallback(InputInterface $input, string $optionName, string $envName): string
    {
        $value = (string) $input->getOption($optionName);
        if (empty($value)) {
            $configuration = (new Configuration())->get();
            $value = (string) $configuration[$envName];
        }

        return $value;
    }

    protected function getClient(): Client
    {
        return new Client();
    }
}
