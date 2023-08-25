<?php

use Globby\Contracts\Responsable;
use Globby\Responders\HtmlResponse;
use Globby\Responders\JsonResponse;
use Globby\Responders\RedirectResponse;
use Globby\Responders\TextResponse;

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

if (! function_exists('Text')) {
    function Text(string $text, int $code = 200): Responsable
    {
        return new TextResponse($text, $code);
    }
}
