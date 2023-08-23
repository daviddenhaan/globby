<?php

use Globby\Contracts\Responsable;
use Globby\Responders\HtmlResponse;
use Globby\Responders\JsonResponse;
use Globby\Responders\RedirectResponse;

if (! function_exists('Html')) {
    function Html(string $body, int $code = 200): Responsable
    {
        return new HtmlResponse($body, $code);
    }
}

if (! function_exists('Redirect')) {
    function Redirect(string $to, int $code = 302): Responsable
    {
        return new RedirectResponse($to, $code);
    }
}

if (! function_exists('Json')) {
    function Json(array $data, int $code = 200): Responsable
    {
        return new JsonResponse($data, $code);
    }
}
