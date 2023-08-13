<?php

use App\Http\Response;

it('returns a correct Response object', function(string $method, string $path, int $statusCode) {

    // ARRANGE
    $request = \App\Http\Request::create($method, $path);
    $handler = fn() => new Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);
    $router = new \App\Routing\Router($routeHandlerResolver);

    $router->setRoutes([
        ['GET', '/foo', $handler]
    ]);

    // ACT
    $response = $router->dispatch($request);

    // ASSERT
    expect($response)
        ->toBeInstanceOf(Response::class)
        ->and($response->getStatusCode())->toBe($statusCode);

})->with([
    '200 OK Response' => ['GET', '/foo', Response::HTTP_OK],
    '404 Response' => ['GET', '/bar', Response::HTTP_NOT_FOUND],
    '405 Response' => ['POST', '/foo', Response::HTTP_METHOD_NOT_ALLOWED],
]);
