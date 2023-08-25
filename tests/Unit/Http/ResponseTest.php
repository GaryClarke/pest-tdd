<?php

use App\Http\JsonResponse;
use App\Http\Response;

test('a Response object can be created', function() {

    // ACT
    $response = new Response('{"foo":"bar"}', 200);

    // ASSERT
    expect($response->getStatusCode())->toBeInt()->toBe(200)
        ->and($response->getBody())
        ->toMatchJson(['foo' => 'bar']);
});

test('a JsonResponse can be created from an object or an array', function ($body) {

    // ARRANGE
    // Create a JsonResponse
    $response = new JsonResponse($body, Response::HTTP_OK);

    // ASSERT (headers, body)
    expect($response->getHeaders())
        ->toMatchArray([
            'Content-Type' => 'application/json'
        ])
        ->and($response->getBody())
        ->toMatchJson(['foo' => 'bar']);
})->with([
    'object' => [
        new class {
            public string $foo = 'bar';
        }
    ],
    'array' => [
        ['foo' => 'bar']
    ]
]);

