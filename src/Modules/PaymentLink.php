<?php

namespace QvaPay\Modules;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

final readonly class PaymentLink extends BaseModule
{

    /**
     * Get the payment links
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#de63a4e8-b771-4f23-9070-96d827e9ab86
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getPaymentLinks(): ResponseInterface
    {
        $request = new Request(
            method: 'GET',
            uri: 'payment_links'
        );

        return $this->send($request);
    }

    /**
     * Create a payment link
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#de63a4e8-b771-4f23-9070-96d827e9ab86
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function createPaymentLink(array $params): ResponseInterface
    {
        $request = new Request(
            method: 'POST',
            uri: 'payment_links/create'
        );

        return $this->send($request);
    }


}