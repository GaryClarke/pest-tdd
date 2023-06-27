<?php

it('creates a correctly formed GET Request object', function() {

    // ACT
    $request = \App\Http\Request::create(
        'GET',
        '/some/path?black=white&day=night',
        [
            'CONTENT_TYPE' => 'application/json',
            'Accept'       => 'application/json'
        ],
        ''
    );

    // ASSERT
    expect($request->getQueryParams())
        ->toMatchArray(['black' => 'white', 'day' => 'night'])
        ->and($request->getPath())
        ->toBe('/some/path')
        ->and($request->getMethod())
        ->toBe('GET');
});

