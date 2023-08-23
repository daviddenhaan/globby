<?php

namespace Globby;

use Exception;
use Globby\Contracts\Application;
use Globby\Contracts\Middleware;
use Globby\Contracts\Router as RouterContract;
use Globby\Exceptions\NotAMiddlewareException;
use Globby\Exceptions\RouteNotFoundException;
use Globby\Middleware\RoutingMiddleware;
use Globby\Middleware\ScopedServiceMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements Application, RouterContract
{
    /**
     * @var array<string, array>
     */
    protected array $routes = [];

    /**
     * @var array<int, Middleware>
     */
    protected array $stack = [];

    public function __construct()
    {
        $this->middleware($this->defaultMiddleware());
    }

    public function defaultMiddleware(): array
    {
        return [
            new RoutingMiddleware($this),
            new ScopedServiceMiddleware($this),
        ];
    }

    /**
     * @param  array<int, Middleware>  $middleware
     */
    public function route(callable $callback, array $middleware = []): static
    {
        $meta = Route::fromCallable($callback);

        $this->routes["{$meta->uri()}:{$meta->method()->name}"] = [
            'handler' => $callback,
            'middleware' => $middleware,
        ];

        return $this;
    }

    public function getRoute(string $uri, string $method): array
    {
        return $this->routes["$uri:$method"] ?? throw new RouteNotFoundException;
    }

    public function getHandler(string $uri, string $method): callable
    {
        return ($this->routes["$uri:$method"] ?? throw new RouteNotFoundException)['handler'];
    }

    /**
     * @param  array<int, Middleware>  $middlewares
     */
    public function middleware(array $middleware = []): static
    {
        $this->stack = [
            ...$this->defaultMiddleware(),
            ...$middleware,
        ];

        return $this;
    }

    /**
     * @param class-string<Middleware>|Middleware
     */
    public function layer($middleware): static
    {
        if (is_string($middleware)) {
            $middleware = new $middleware;
        }

        if (! $middleware instanceof Middleware) {
            throw new NotAMiddlewareException;
        }

        $this->stack[] = $middleware;

        return $this;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $stack = new Stack(array_reverse($this->stack));

        return $stack->next($request);
    }
}
