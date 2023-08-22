<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ResponseInterface;

class HtmlResponse implements Responsable
{
    protected string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function respond(): ResponseInterface
    {
        return new Response(
            $this->body,
            200,
            headers: ['Content-Type' => 'text/html'],
        );
    }
}
