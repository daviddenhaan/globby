<?php

require __DIR__.'/../vendor/autoload.php';

use Globby\Contracts\Middleware;
use Globby\Contracts\Responsable;
use Globby\Contracts\Stack;
use Globby\Route;
use Globby\Router;
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
    public function call(ServerRequestInterface $request, Stack $stack): Response
    {
        $date = date(DATE_RSS);

        echo "[$date] Handling request on uri: {$request->getUri()}\n";

        return $stack->next($request);
    }
}

$application = (new Router)
    ->route(root::class)
    ->layer(new RequestLoggingMiddleware);

$server = new Server('127.0.0.1', 8080);

$server->setHandler($application);

$server->start();
