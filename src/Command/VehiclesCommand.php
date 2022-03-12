<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VehiclesCommand extends AbstractNiuCommand
{
    protected static $defaultName = 'niu:vehicles';

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Get vehicle information');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $request = new Request(
            'POST',
            'https://app-api-fk.niu.com/motoinfo/list',
            [
                'Accept-Language' => 'en-US',
                'Token' => $this->getCurrentToken($input),
            ]
        );

        $client = new Client();
        $response = $client->sendRequest($request);

        $result = json_decode($response->getBody()->getContents());

        if (!isset($result->data)) {
            $output->writeln('Invalid request');

            return self::FAILURE;
        }

        $table = new Table($output);
        $table->setHeaders(['SN', 'Name'])
            ->setRows(array_map(fn ($item) => [$item->sn, $item->name], $result->data))
        ;
        $table->render();

        return self::SUCCESS;
    }
}
