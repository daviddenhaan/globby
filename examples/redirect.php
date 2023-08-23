<?php

require __DIR__.'/../vendor/autoload.php';

use Globby\Method;
use Globby\Routing\Route;
use Globby\Routing\Router;
use OpenSwoole\Http\Server;

#[Route('/', Method::GET)]
function hello()
{
    return Redirect('/redirected');
}

#[Route('/redirected')]
function redirected()
{
    return Html('You got redirected!');
}

$application = (new Router)
    ->route(hello::class)
    ->route(redirected::class);

$server = new Server('127.0.0.1', 8080);

$server->setHandler($application);

$server->start();
