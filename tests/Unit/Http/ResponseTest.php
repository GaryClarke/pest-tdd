<?php

test('a Response object can be created', function() {

    // ACT
    $response = new \App\Http\Response('{"foo":"bar"}', 200);

    // ASSERT
    expect($response->getStatusCode())->toBeInt()->toBe(200)
        ->and($response->getBody())
        ->toMatchJson(['foo' => 'bar']);
});

