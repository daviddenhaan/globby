<?php

require __DIR__.'/../vendor/autoload.php';

use Globby\Contracts\Middleware;
use Globby\Contracts\Responsable;
use Globby\Contracts\Stack;
use Globby\Routing\Route;
use Globby\Routing\Router;
use OpenSwoole\Core\Psr\Response;
use OpenSwoole\Http\Server;
use Psr\Http\Message\ServerRequestInterface;

#[Route('/')]
function root(): Responsable
{
    return Html('Hello!');
}

class RequestLoggingMiddleware implements Middleware
{
    public function handle(ServerRequestInterface $request, Stack $stack): Response
    {
        $date = date(DATE_RSS);

        echo "[$date] Handling request on uri: {$request->getUri()}\n";

        return $stack->next($request);
    }
}

$application = (new Router)
    ->route(root::class)
    ->layer(RequestLoggingMiddleware::class);

$server = new Server('127.0.0.1', 8080);

$server->setHandler($application);

$server->start();
