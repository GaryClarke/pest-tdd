<?php

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private iterable $routes;

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
                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                if (is_array($handler)) {
                    $handler = [new $handler[0], $handler[1]];
                }

                // ... call $handler with $vars
                $response = $handler(...$vars);
                break;
        }

        return $response;
    }
}