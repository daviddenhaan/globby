<?php

require __DIR__.'/../vendor/autoload.php';

use Globby\Contracts\Middleware;
use Globby\Contracts\Stack;
use Globby\Route;
use Globby\Router;
use OpenSwoole\Http\Server;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

#[Route('/')]
function root()
{
    return Html('TestMiddleware is not applied here.');
}

#[Route('/scoped')]
function scoped()
{
    return Html('TestMiddleware is applied here!');
}

class TestMiddleware implements Middleware
{
    public function handle(ServerRequestInterface $request, Stack $stack): ResponseInterface
    {
        echo 'It works!!';

        return $stack->next($request);
    }
}

$application = (new Router)
    ->route(root::class)
    ->route(scoped::class, [new TestMiddleware]);

$server = new Server('127.0.0.1', 8080);

$server->setHandler($application);

$server->start();
