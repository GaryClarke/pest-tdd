<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;

class RouterDispatch implements MiddlewareInterface
{
    public function __construct(
        private Router $router
    )
    {
    }

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        return $this->router->dispatch($request);
    }
}