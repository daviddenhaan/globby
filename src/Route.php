<?php

namespace Globby;

use Attribute;
use Globby\Exceptions\NotARouteException;
use ReflectionFunction;

#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD)]
final class Route
{
    protected readonly string $uri;

    protected readonly Method $method;

    public function __construct(string $uri, ?Method $method = Method::GET)
    {
        $this->uri = $uri;

        if (is_null($method)) {
            $method = Method::GET;
        }

        $this->method = $method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function method(): Method
    {
        return $this->method;
    }

    public static function fromCallable(callable $handler): self
    {
        $reflect = new ReflectionFunction($handler);
        $attribute = $reflect->getAttributes(Route::class)[0] ?? null;

        if ($attribute == null) {
            throw new NotARouteException();
        }

        return new self(...$attribute->getArguments());
    }
}
