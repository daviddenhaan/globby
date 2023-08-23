<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ResponseInterface;

class HtmlResponse implements Responsable
{
    protected string $body;

    protected int $code;

    public function __construct(string $body, int $code)
    {
        $this->body = $body;
        $this->code = $code;
    }

    public function respond(): ResponseInterface
    {
        return new Response(
            $this->body,
            $this->code,
            headers: ['Content-Type' => 'text/html'],
        );
    }
}
