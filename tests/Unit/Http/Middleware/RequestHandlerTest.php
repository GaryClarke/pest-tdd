<?php

use App\Http\Middleware\RequestHandler;
use App\Http\Response;
use Tests\Unit\Http\Middleware\SuccessMiddleware;

beforeEach(function() {
    $this->container = include dirname(__DIR__, 4) . '/config/services.php';
});

test('RequestHandler returns a correct Response', function() {

    // ARRANGE
    $request = \App\Http\Request::create('GET', '/some/uri');

    $requestHandler = new RequestHandler($this->container);

    $requestHandler->setMiddleware([SuccessMiddleware::class]);

    // ACT
    $response = $requestHandler->handle($request);

    // ASSERT
    expect($response)
        ->toBeInstanceOf(Response::class)
        ->and($response->getStatusCode())->toBe(200);
});

