<?php

declare(strict_types=1);

/*
 * This file is part of OBOOM PHP Client.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plients\OBOOM\API;

use Plients\Http\HttpResponse;
use Plients\Http\PendingHttpRequest;

abstract class AbstractAPI
{
    /**
     * @var \Plients\Http\PendingHttpRequest
     */
    protected $client;

    /**
     * Create a new API class instance.
     *
     * @param \Plients\Http\PendingHttpRequest $client
     */
    public function __construct(PendingHttpRequest $client)
    {
        $this->client = $client;
    }

    public function post(string $method, array $parameters): HttpResponse
    {
        return $this
            ->client
            ->withBaseUri("http://{$this->endpoint}.oboom.com/1/")
            ->post($method, ['token' => $this->token] + $parameters);
    }
}
