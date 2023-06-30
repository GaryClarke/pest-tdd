<?php

it('retrieves the correct book 1 data from the books API', function() {

    // ARRANGE

    // ACT
    $response = $this->json(method: 'GET', uri: '/books/1');

    // ASSERT
    expect($response->getStatusCode())->toBeInt()->toBe(200)
        ->and($response->getBody())->toMatchJson([
            'id' => 1,
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'year_published' => 2008,
            'author' => [
                'id' => 1,
                'name' => 'Robert C. Martin',
                'bio' => 'This is an author'
            ]
        ]);
});

it('retrieves the correct book 2 data from the books API', function() {

    // ARRANGE
    // Data fixtures

    // ACT
    // Send a get request to the API
    $response = $this->json(method: 'GET', uri: '/books/2');

    // ASSERT
    expect($response->getStatusCode())->toBeInt()->toBe(200) // 200 status received
    ->and($response->getBody())->toMatchJson([
        'id' => 2,
        'title' => 'Refactoring: Improving the Design of Existing Code',
        'yearPublished' => 1999,
        'author' => [
            'id' => 2,
            'name' => 'Martin Fowler',
            'bio' => 'Martin\'s bio'
        ]
    ]);
});

