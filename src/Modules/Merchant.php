<?php

declare(strict_types=1);

namespace QvaPay\Modules;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

final readonly class Merchant extends BaseModule
{
    public function __construct(
        private string $appId,
        private string $appSecret,
    )
    {

    }

    /**
     * Obtener información sobre la APP consultada para verificar estado de la misma.
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#1a93b49e-4a36-4263-9f53-b9b84b610d34
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function info(): ResponseInterface
    {
        $request = new Request(
            method: 'POST',
            uri: '/v2/info',
            body: $this->bodyParams()
        );

        return $this->send($request);
    }

    private function bodyParams(array $extraParams = []): string
    {
        return json_encode([
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            ...$extraParams
        ]);
    }

    /**
     * Obtener el balance de la cuenta padre de esta APP de desarrollo.
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#6ba4a6d2-d5c7-4a85-a529-532c4e7bf50e
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function ownerBalance(): ResponseInterface
    {
        $request = new Request(
            method: 'POST',
            uri: '/v2/balance',
            body: $this->bodyParams()
        );

        return $this->send($request);
    }

    /**
     * Crear una factura desde una APP de desarrollo.
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#ba56fbcb-aca8-47db-ae00-ac177cfdb054
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function createInvoice(array $params): ResponseInterface
    {
        $request = new Request(
            method: 'POST',
            uri: '/v2/create_invoice',
            body: $this->bodyParams($params)
        );

        return $this->send($request);
    }

    /**
     * Obtener facturas
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#fc084c1d-24d9-4c2a-94e1-adbd12b39cc7
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getTransactions(): ResponseInterface
    {
        $request = new Request(
            method: 'POST',
            uri: '/v2/transactions',
            body: $this->bodyParams()
        );

        return $this->send($request);
    }
}