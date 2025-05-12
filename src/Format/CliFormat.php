<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Format;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class CliFormat extends AbstractFormat
{
    public function output(OutputInterface $output, array $data): void
    {
        if (empty($data)) {
            return;
        }

        $table = new Table($output);
        $table->setHeaders(array_keys($data[0]))
            ->setRows($data);
        $table->render();
    }
}
