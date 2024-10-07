<?php
declare(strict_types=1);

namespace QvaPay\Modules;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use QvaPay\HttpClient;

readonly  class BaseModule
{

    /**
     * @throws GuzzleException
     */
    protected function send(Request $request): ResponseInterface
    {
        return $this->http()->send($request);
    }

    protected function http(): Client
    {
        return $client = HttpClient::class::getClient();
    }
}