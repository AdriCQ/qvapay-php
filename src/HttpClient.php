<?php

declare(strict_types=1);

namespace QvaPay;

use GuzzleHttp\Client;

class HttpClient
{
    // Hold the instance of the Guzzle client
    private static ?Client $client = null;
    private static string $baseUrl = 'https://api.qvapay.com/api';
    private static string|null $appKey = null;
    private static string|null $appSecret = null;
    private static string|null $authToken = null;

    // Private constructor to prevent instantiation
    private function __construct()
    {

    }


    /**
     * Get the singleton instance of the Guzzle client.
     *
     * @param string $baseUrl
     * @param string|null $authToken
     * @param string|null $appKey
     * @param string|null $appSecret
     * @return Client
     */
    public static function getClient(
        string $baseUrl = 'https://api.qvapay.com/api',
        string $authToken = null,
        string $appKey = null,
        string $appSecret = null,
    ): Client
    {

        self::setConfig(
            baseUrl: $baseUrl,
            authToken: $authToken,
            appKey: $appKey,
            appSecret: $appSecret
        );

        if (self::$client === null) {
            $config = [
                'base_uri' => self::$baseUrl,
                'timeout' => 5.0,
            ];

            if (self::$authToken) {
                $config['headers'] = [
                    'Authorization' => 'Bearer ' . self::$authToken,
                ];
            }

            self::$client = new Client($config);
        }

        return self::$client;
    }

    private static function setConfig(
        string $baseUrl = null,
        string $authToken = null,
        string $appKey = null,
        string $appSecret = null,
    )
    {
        if ($authToken) self::$authToken = $authToken;
        if ($baseUrl) self::$baseUrl = $baseUrl;
        if ($appKey) self::$appKey = $appKey;
        if ($appSecret) self::$appSecret = $appSecret;
    }

    public static function setAuthToken(string|null $token): void
    {
        self::$authToken = $token;
    }
}