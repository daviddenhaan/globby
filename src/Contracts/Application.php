<?php

namespace Globby\Contracts;

use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;

interface Application
{
    public function route(callable $route): static;

    public function handle(Request $request, Response $response): void;
}
