<?php

namespace Globby\Contracts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface Application extends RequestHandlerInterface
{
    public function route(callable $route): static;

    public function getHandler(string $uri, string $method): callable;

    public function handle(ServerRequestInterface $request): ResponseInterface;
}
