<?php

namespace Globby\Contracts;

interface Router
{
    public function route(callable $route): static;

    public function getRoute(string $uri, string $method): array;

    public function getHandler(string $uri, string $method): callable;
}
