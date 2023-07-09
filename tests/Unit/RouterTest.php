<?php

it('returns a 200 Response object if a valid route exists', function() {

    // ARRANGE
    $request = \App\Http\Request::create('GET', '/foo');
    $handler = fn() => new \App\Http\Response();
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
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())->toBe(200);

});

it('returns a 404 Response object if a route does not exist', function() {

})->todo();

it('returns a 405 Response object if a not allowed method is used', function() {

})->todo();