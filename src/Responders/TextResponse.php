<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ResponseInterface;

class TextResponse implements Responsable
{
    protected string $text;

    protected int $code;

    public function __construct(string $text, int $code = 200)
    {
        $this->text = $text;
        $this->code = $code;
    }

    public function respond(): ResponseInterface
    {
        return new Response(
            $this->text,
            $this->code,
            headers: ['Content-Type' => 'text/plain'],
        );
    }
}
