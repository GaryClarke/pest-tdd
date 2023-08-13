<?php

namespace App\Http;

use App\Routing\Router;

class Kernel
{
    public function __construct(
        private Router $router
    )
    {
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}