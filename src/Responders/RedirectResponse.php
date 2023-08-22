<?php

namespace Globby\Responders;

use Globby\Contracts\Responsable;
use OpenSwoole\Http\Response;

class RedirectResponse implements Responsable
{
    protected string $to;

    protected int $code;

    public function __construct(string $to, int $code)
    {
        $this->to = $to;
        $this->code = $code;
    }

    public function transform(Response $response): void
    {
        $response->status(301);

        $response->header('Location', $this->to);
    }
}
