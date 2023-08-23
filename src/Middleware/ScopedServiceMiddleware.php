<?php

namespace Globby\Middleware;

use Globby\Contracts\Middleware;
use Globby\Contracts\Router;
use Globby\Contracts\Stack as ContractsStack;
use Globby\Stack;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ScopedServiceMiddleware implements Middleware
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request, ContractsStack $stack): ResponseInterface
    {
        $middleware = $this->router->getRoute($request->getUri(), $request->getMethod())['middleware'];

        $stack = new Stack([
            ...$middleware,
            ...$stack->remaining(),
        ]);

        return $stack->next($request);
    }
}
