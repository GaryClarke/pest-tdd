<?php

use App\Routing\RouteHandlerResolver;

beforeEach(function() {
    $this->container = include dirname(__DIR__, 3) . '/config/services.php';
});

it('resolves the correct route handler closure', function () {
    // ARRANGE
    $routeHandlerResolver = new RouteHandlerResolver($this->container);
    $handlerInfo = fn() => 'foo';

    // ACT
    $handler = $routeHandlerResolver->resolve($handlerInfo);

    // ASSERT
    expect($handler)
        ->toBeCallable()
        ->toBe($handlerInfo);
});

it('resolves the correct route handler controller', function () {
    // ARRANGE
    $routeHandlerResolver = new RouteHandlerResolver($this->container);
    $handlerInfo = [\App\Controller\BooksController::class, 'show'];

    // ACT
    $handler = $routeHandlerResolver->resolve($handlerInfo);

    // ASSERT
    expect($handler)
        ->toBeCallable()
        ->and($handler[0])->toBeInstanceOf(\App\Controller\BooksController::class);
});