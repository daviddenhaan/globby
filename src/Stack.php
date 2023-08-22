<?php

namespace Globby;

use Globby\Contracts\Stack as StackContract;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Stack implements StackContract
{
    /**
     * @var array<int, Middleware>
     */
    protected array $inner;

    public function __construct(array $stack)
    {
        $this->inner = $stack;
    }

    public function next(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = array_shift($this->inner);

        return $middleware->call($request, $this);
    }
}
