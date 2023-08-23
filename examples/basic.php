<?php

require __DIR__.'/../vendor/autoload.php';

use Globby\Contracts\Responsable;
use Globby\Method;
use Globby\Routing\Route;
use Globby\Routing\Router;
use OpenSwoole\Http\Server;

#[Route('/', Method::GET)]
function hello(): Responsable
{
    return Html('Hello, World!');
}

$application = (new Router)
    ->route(hello::class);

$server = new Server('127.0.0.1', 8080);

$server->setHandler($application);

$server->start();
