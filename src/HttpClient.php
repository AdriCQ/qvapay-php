<?php

declare(strict_types=1);

namespace QvaPay;

use GuzzleHttp\Client;

class HttpClient
{
    // Hold the instance of the Guzzle client
    private static ?Client $client = null;
    private static string $baseUrl = 'https://api.qvapay.com/api';
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
     * @return Client
     */
    public static function getClient(
        string $baseUrl = 'https://api.qvapay.com/api',
        string $authToken = null,
    ): Client
    {

        self::setConfig(
            baseUrl: $baseUrl,
            authToken: $authToken,
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
    ): void
    {
        if ($authToken) self::$authToken = $authToken;
        if ($baseUrl) self::$baseUrl = $baseUrl;
    }

    public static function setAuthToken(string|null $token): void
    {
        self::$authToken = $token;
    }
}