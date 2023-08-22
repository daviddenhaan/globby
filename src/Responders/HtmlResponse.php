<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Http\Response;

class HtmlResponse implements Responsable
{
    protected string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function transform(Response $response): void
    {
        $response->header('Content-Type', 'text/html');

        $response->status(200);

        $response->end($this->body);
    }
}
