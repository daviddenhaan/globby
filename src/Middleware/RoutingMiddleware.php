<?php

namespace Globby\Middleware;

use Globby\Contracts\Middleware;
use Globby\Contracts\Router;
use Globby\Contracts\Stack;
use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ServerRequestInterface;

class RoutingMiddleware implements Middleware
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request, Stack $stack): Response
    {
        $handler = $this->router->getHandler($request->getUri(), $request->getMethod());

        return $handler($request)->respond();
    }
}
