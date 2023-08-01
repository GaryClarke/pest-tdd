<?php

use App\Repository\BookRepository;

uses(\Tests\ApiTestCase::class);

beforeEach(function() {
    $this->migrateTestDatabase();
});

it('returns the correct book data by ID', function() {

    // ARRANGE
    $bookId = 999;
    $connection = $this->container->get(\App\Database\Connection::class);
    $bookRepository = new BookRepository($connection);

    // ACT
    $foundBook = $bookRepository->findById($bookId);

    // ASSERT
    expect($foundBook)->toMatchObject([
        'title' => 'A Test Book',
        'yearPublished' => 1999,
    ])
        ->and($foundBook->author)->toMatchObject([
            'name' => 'A. N. Author',
            'bio' => 'This is an author'
        ]);

})->group('integration');

