<?php

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

# parameters
$dsn = $_ENV['DSN'];
$container->add('dsn', new \League\Container\Argument\Literal\StringArgument($dsn));
$routes = include __DIR__ . '/routes.php';
$migrationsFolder = dirname(__DIR__) . '/migrations';
$container->add(
    'migrations_folder',
    new \League\Container\Argument\Literal\StringArgument($migrationsFolder)
);
$jwtSecretKey = $_ENV['JWT_SECRET_KEY'];
$container->add('jwtSecretKey', new \League\Container\Argument\Literal\StringArgument($jwtSecretKey));

# services
$container->add(\App\Routing\RouteHandlerResolver::class)
    ->addArguments([$container]);

$container->add(\App\Routing\Router::class)
    ->addArguments([\App\Routing\RouteHandlerResolver::class]);

$container->extend(\App\Routing\Router::class)
    ->addMethodCall('setRoutes', [$routes]);

$container->add(
    \App\Http\Middleware\RequestHandlerInterface::class,
    \App\Http\Middleware\RequestHandler::class
)->addArgument($container);

$container->add(\App\Http\Kernel::class)
    ->addArguments([\App\Http\Middleware\RequestHandlerInterface::class]);

$container->addShared(\App\Database\Connection::class)
    ->addArguments(['dsn']);



return $container;

