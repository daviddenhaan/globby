<?php

namespace Globby\Contracts;

use OpenSwoole\Http\Response;

interface Responsable
{
    public function transform(Response $response): void;
}
