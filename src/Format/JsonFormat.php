<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Format;

use Symfony\Component\Console\Output\OutputInterface;

class JsonFormat extends AbstractFormat
{
    public function output(OutputInterface $output, array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (is_array($data) && sizeof($data) === 1) {
            $data = $data[0];
        }
        $output->writeln(json_encode($data, JSON_PRETTY_PRINT));
    }
}
