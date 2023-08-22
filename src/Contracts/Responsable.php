<?php

namespace Globby\Contracts;

use Psr\Http\Message\ResponseInterface;

interface Responsable
{
    public function respond(): ResponseInterface;
}
