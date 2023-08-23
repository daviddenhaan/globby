<?php

namespace Globby\Contracts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Middleware
{
    public function handle(ServerRequestInterface $request, Stack $stack): ResponseInterface;
}
