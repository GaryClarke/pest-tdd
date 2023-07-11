<?php

namespace App\Routing;

class RouteHandlerResolver
{
    public function resolve(\Closure|array $handler): callable
    {
        return $handler;
    }
}