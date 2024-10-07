<?php

namespace QvaPay;

use GuzzleHttp\Client;
use QvaPay\Modules\Auth;
use QvaPay\Modules\Merchant;
use QvaPay\Modules\PaymentLink;
use QvaPay\Modules\User;

readonly class QvaPay
{
    private Client $client;

    public function __construct(
        private string $apiBaseUrl = 'https://api.qvapay.com/api',

    )
    {
        $this->client = HttpClient::getClient(
            baseUrl: $this->apiBaseUrl,
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
     * @param string $appId
     * @param string $appSecret
     * @return Merchant
     */
    public function merchant(string $appId, string $appSecret): Merchant
    {
        return new Merchant(
            appId: $appId, appSecret: $appSecret,
        );
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