<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use Lochmueller\NiuApiConnector\Client;
use Lochmueller\NiuApiConnector\Configuration;
use Lochmueller\NiuApiConnector\Format\AbstractFormat;
use Lochmueller\NiuApiConnector\Format\CliFormat;
use Lochmueller\NiuApiConnector\Format\JsonFormat;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

abstract class AbstractNiuCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption('format', 'f', InputOption::VALUE_REQUIRED, 'Output format. Valid formats are "json" and "cli". Default is "cli"', 'cli');
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

    protected function getFormatter(InputInterface $input): AbstractFormat
    {
        switch ($input->getOption('format')) {
            case 'json':
                return new JsonFormat();
        }

        return new CliFormat();
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

    protected function flattenArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($value instanceof \stdClass) {
                $values = $this->flattenArray((array) $value);
                foreach ($values as $innerKey => $innerValue) {
                    $data[$key.'_'.$innerKey] = $innerValue;
                }
                unset($data[$key]);
            }
        }

        return $data;
    }
}
