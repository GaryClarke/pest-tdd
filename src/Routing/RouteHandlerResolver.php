<?php

declare(strict_types=1);

namespace App\Routing;

use League\Container\Container;

class RouteHandlerResolver
{
    public function __construct(private Container $container)
    {
    }

    public function resolve(\Closure|array $handler): callable
    {
        if (is_array($handler)) {
            $handler = [$this->container->get($handler[0]), $handler[1]];
        }

        return $handler;
    }
}