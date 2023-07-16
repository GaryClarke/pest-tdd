<?php

use App\Repository\BookRepository;

it('returns the correct book data by ID', function() {

    // ARRANGE
    $bookId = 999;
    $bookRepository = new BookRepository();

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

