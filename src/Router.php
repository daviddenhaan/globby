<?php

namespace Globby;

use Globby\Contracts\Application;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;

class Router implements Application
{
    /**
     * @var array<string, callable>
     */
    protected array $routes = [];

    public function __construct()
    {
        //
    }

    public function route(callable $route): static
    {
        $meta = Route::fromCallable($route);

        $this->routes["{$meta->uri()}:{$meta->method()->name}"] = $route;

        return $this;
    }

    public function handle(Request $request, Response $response): void
    {
        $uri = $request->server['request_uri'];
        $method = $request->getMethod();

        $handler = $this->routes["$uri:$method"] ?? null;

        if (is_null($handler)) {
            return;
        }

        $handler($request)->transform($response);
    }
}
