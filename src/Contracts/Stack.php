<?php

namespace Globby\Contracts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Stack
{
    /**
     * @var array<int, Middleware> $stack
     */
    public function __construct(array $stack);

    public function remaining(): array;

    public function next(ServerRequestInterface $request): ResponseInterface;
}
