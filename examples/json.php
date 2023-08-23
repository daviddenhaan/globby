<?php

require __DIR__.'/../vendor/autoload.php';

use Globby\Routing\Route;
use Globby\Routing\Router;
use OpenSwoole\Http\Server;

$user = [
    'id' => 123,
    'name' => 'globby',
    'email' => 'globby@example.com',
];

#[Route('/')]
function hello()
{
    global $user;

    return Json([
        'user' => $user,
    ]);
}

$application = (new Router)
    ->route(hello::class);

$server = new Server('127.0.0.1', 8080);

$server->setHandler($application);

$server->start();
