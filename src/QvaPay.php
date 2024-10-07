<?php

namespace QvaPay;

use GuzzleHttp\Client;
use QvaPay\Modules\Auth;
use QvaPay\Modules\PaymentLink;
use QvaPay\Modules\User;

readonly class QvaPay
{
    private Client $client;

    public function __construct(
        private string      $apiBaseUrl = 'https://api.qvapay.com/api',
        private string|null $apiKey = null,
        private string|null $apiSecret = null,

    )
    {
        $this->client = HttpClient::getClient(
            baseUrl: $this->apiBaseUrl,
            appKey: $this->apiKey,
            appSecret: $this->apiSecret
        );
    }

    /**
     * @return Auth
     */
    public function auth(): Auth
    {
        return new Auth();
    }

    /**
     * @return PaymentLink
     */
    public function paymentLink(): PaymentLink
    {
        return new PaymentLink();
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return new User();
    }

}