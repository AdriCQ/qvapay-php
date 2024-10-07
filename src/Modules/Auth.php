<?php

declare(strict_types=1);

namespace QvaPay\Modules;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use QvaPay\HttpClient;

final readonly class Auth extends BaseModule
{

    /**
     * Login de su cuenta de usuario. El email & password es enviado vía SSL. (Puede codificar previamente la contraseña con base64).
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#d4b8844a-6ac1-4e8a-96fd-a0317b24ac5e
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function login(array $params): ResponseInterface
    {
        $query = new Request(
            method: 'POST',
            uri: 'auth/login',
            body: json_encode($params)
        );

        return $this->handleAuthenticatedResponse($this->send($query));
    }

    /**
     * setAuthentication
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    private function handleAuthenticatedResponse(ResponseInterface $response): ResponseInterface
    {

        $body = $response->getBody();

        if (json_validate((string)$body, depth: JSON_NUMERIC_CHECK)) {
            $responseJson = json_decode((string)$body, true);
            if (array_key_exists('accessToken', $responseJson)) {
                HttpClient::setAuthToken($responseJson['accessToken']);
            } else {
                HttpClient::setAuthToken(token: null);
            }
        }

        return $response;
    }

    /**
     * Registrar un usuario en QvaPay, envía los datos requeridos y recibirá el "token de la sesión".
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#2928419b-5cbd-4656-9c80-bff7f7ffedf3
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function register(array $params): ResponseInterface
    {
        $query = new Request(
            method: 'POST',
            uri: 'auth/register',
            body: json_encode($params)
        );

        return $this->handleAuthenticatedResponse($this->send($query));

    }

    /**
     * Cerrar la sesión de determinado usuario.
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#57bb4d43-8c25-4c50-8b38-5afa11f5f082
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function logout(): ResponseInterface
    {
        $query = new Request(
            method: 'GET',
            uri: 'auth/logout',
        );

        return $this->handleAuthenticatedResponse($this->send($query));
    }
}