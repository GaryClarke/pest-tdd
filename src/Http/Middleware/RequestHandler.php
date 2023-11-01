<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use Psr\Container\ContainerInterface;

class RequestHandler implements RequestHandlerInterface
{
    private array $middleware = [
        RouterDispatch::class
    ];

    public function __construct(
        private ContainerInterface $container
    )
    {
    }

    public function handle(Request $request): Response
    {
        // Check we have middleware
        if (empty($this->middleware)) {
            return new Response("A Response can not be sent", 500);
        }

        // Retrieve next middleware in the array
        $middlewareClassname = array_shift($this->middleware);

        // Instantiate Middleware class
        $middleware = $this->container->get($middlewareClassname);

        // Call process on the middleware to obtain a response
        $response = $middleware->process($request, $this);

        // Return the response
        return $response;
    }

    public function setMiddleware(array $middleware): void
    {
        $this->middleware = $middleware;
    }
}