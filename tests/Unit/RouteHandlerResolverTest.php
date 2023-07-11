<?php

use App\Routing\RouteHandlerResolver;

it('resolves the correct route handler closure', function () {
    // ARRANGE
    $routeHandlerResolver = new RouteHandlerResolver();
    $handlerInfo = fn() => 'foo';

    // ACT
    $handler = $routeHandlerResolver->resolve($handlerInfo);

    // ASSERT
    expect($handler)->toBe($handlerInfo);
});

it('resolves the correct route handler controller', function () {

})->todo();