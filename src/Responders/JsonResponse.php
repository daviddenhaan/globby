<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ResponseInterface;

class JsonResponse implements Responsable
{
    protected array $data;

    protected int $code;

    public function __construct(array $data, int $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    public function respond(): ResponseInterface
    {
        return new Response(
            json_encode($this->data),
            $this->code,
            headers: ['Content-Type' => 'application/json'],
        );
    }
}