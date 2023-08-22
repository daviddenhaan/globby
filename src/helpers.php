<?php

use Globby\Contracts\Responsable;
use Globby\Responders\HtmlResponse;
use Globby\Responders\RedirectResponse;

if (! function_exists('Html')) {
    function Html(string $body): Responsable
    {
        return new HtmlResponse($body);
    }
}

if (! function_exists('Redirect')) {
    function Redirect(string $to, int $code = 302): Responsable
    {
        return new RedirectResponse($to, $code);
    }
}
