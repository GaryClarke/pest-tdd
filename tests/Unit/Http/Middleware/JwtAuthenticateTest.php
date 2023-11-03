<?php

use App\Http\Middleware\JwtAuthenticate;
use App\Http\Middleware\RequestHandlerInterface;

test('JWT authentication produces the correct response', function() {

    // ARRANGE

    // Request
    $request = \App\Http\Request::create(
        'GET',
        '/some/path',
        ['HTTP_AUTHORIZATION' => 'Bearer some.fake.token'],
    );

    // Middleware
    $jwtAuth = new JwtAuthenticate('some-secret-key');

    // RequestHandlerInterface
    $requestHandler = Mockery::mock(RequestHandlerInterface::class);

    // ACT
    // Middleware process()
    $response = $jwtAuth->process($request, $requestHandler);

    // ASSERT
    // Expect 401 response
    // Invalid token header
    expect($response)
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())->toBe(401)
        ->and($response->getHeaders()['WWW-Authenticate'])->toBe('Bearer error="invalid_token"');
});

