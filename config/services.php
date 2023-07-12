<?php

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters
$routes = include __DIR__ . '/routes.php';

# services
$container->add(\App\Routing\RouteHandlerResolver::class)
    ->addArguments([$container]);

$container->add(\App\Routing\Router::class)
    ->addArguments([\App\Routing\RouteHandlerResolver::class]);

$container->extend(\App\Routing\Router::class)
    ->addMethodCall('setRoutes', [$routes]);

$container->add(\App\Http\Kernel::class)
    ->addArguments([\App\Routing\Router::class]);

return $container;

