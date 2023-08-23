<?php

namespace Globby\Middleware;

use Globby\Contracts\Middleware;
use Globby\Contracts\Router;
use Globby\Contracts\Stack;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RoutingMiddleware implements Middleware
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request, Stack $stack): ResponseInterface
    {
        $handler = $this->router->getHandler($request->getUri(), $request->getMethod());

        return $handler($request)->respond();
    }
}
