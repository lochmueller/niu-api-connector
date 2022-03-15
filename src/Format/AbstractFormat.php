<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Format;

use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractFormat
{
    abstract public function output(OutputInterface $output, array $data);
}
