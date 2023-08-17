<?php

declare(strict_types=1);

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private iterable $routes;

    public function __construct(private RouteHandlerResolver $routeHandlerResolver)
    {
    }

    public function setRoutes(iterable $routes): void
    {
        $this->routes = $routes;
    }

    public function dispatch(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute(...$route);
            }
        });

        // Fetch method and URI from somewhere
        $httpMethod = $request->getMethod();
        $uri = $request->getPath();

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $response = new Response('Route not found', Response::HTTP_NOT_FOUND);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                $response = new Response('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $handler = $this->routeHandlerResolver->resolve($handler);
                $response = $handler(...$vars);
                break;
        }

        return $response;
    }
}