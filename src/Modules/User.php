<?php

declare(strict_types=1);

namespace QvaPay\Modules;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

final readonly class User extends BaseModule
{
    /**
     * Obtener el usuario con los datos públicos y listado de últimas transacciones.
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#c21a8878-95cd-43d5-8ea0-d05f0d0becbd
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMe(): ResponseInterface
    {
        $request = new Request(method: 'GET', uri: '/user');

        return $this->send($request);
    }

    /**
     * Get extended user data like Ranking, Completed p2p operations and badges.
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#fa397522-305a-47ce-8230-743489e8726d
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMeExtended(): ResponseInterface
    {
        $request = new Request('GET', '/user/extended');

        return $this->send($request);
    }

    /**
     * TopUp Balance
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#1e6969b9-a453-4057-af94-5827a1f7d42b
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function topUpBalance(array $params): ResponseInterface
    {
        $request = new Request(method: 'POST', uri: '/topup', body: $params);

        return $this->send($request);
    }

    /**
     * Withdraw Balance
     *
     * @link https://documenter.getpostman.com/view/8765260/TzzHnDGw#b421f999-b699-45f6-adf0-9e29d7402a49
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function withdrawBalance(array $params): ResponseInterface
    {
        $request = new Request(method: 'POST', uri: '/withdraw', body: $params);

        return $this->send($request);
    }
}