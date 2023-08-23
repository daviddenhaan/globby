<?php

namespace Globby\Contracts;

interface Router
{
    public function route(callable $route): static;

    public function getHandler(string $uri, string $method): callable;
}
