<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ResponseInterface;

class RedirectResponse implements Responsable
{
    protected string $to;

    protected int $code;

    public function __construct(string $to, int $code)
    {
        $this->to = $to;
        $this->code = $code;
    }

    public function respond(): ResponseInterface
    {
        return new Response(
            '',
            $this->code,
            headers: ['Location' => $this->to]
        );
    }
}
