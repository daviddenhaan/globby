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
        $this->method = $method ?? Method::GET;
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

        $attribute = $reflect->getAttributes(Route::class)[0]
            ?? throw new NotARouteException();

        return new self(...$attribute->getArguments());
    }
}
