<?php

// Remember to require your autoload!

use Globby\Contracts\Responsable;
use Globby\Method;
use Globby\Route;
use Globby\Router;
use OpenSwoole\Http\Server;

#[Route('/')]
function root(): Responsable
{
    return Redirect('/hello');
}

#[Route('/hello')]
function hello(): Responsable
{
    return Html('Hello, World!');
}

#[Route('/bye', Method::GET)]
function bye(): Responsable
{
    return Html('Goodbye, World!');
}

$application = (new Router)
    ->route(root::class)
    ->route(hello::class)
    ->route(bye::class);

$server = new Server('127.0.0.1', 8080);

$server->on('request', function ($request, $response) use ($application) {
    $application->handle($request, $response);
});

$server->start();
