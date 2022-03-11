<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    public function send(RequestInterface $request): ResponseInterface
    {
        $client = new \GuzzleHttp\Client();

        return $client->sendRequest($request);
    }
}
