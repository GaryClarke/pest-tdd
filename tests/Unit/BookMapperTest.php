<?php

use App\Entity\Author;
use App\Entity\Book;
use App\Repository\AuthorMapper;
use App\Repository\BookMapper;

uses(\Tests\ApiTestCase::class);

beforeEach(function () {
    $this->migrateTestDatabase();
});

it('saves a Book to the database', function() {
    // ARRANGE
    $author = Author::create(null, 'Alan Turing', 'A math genius');
    $authorMapper = new AuthorMapper($this->connection);
    $authorMapper->save($author);

    $book = Book::create(null, 'A book', 1999, $author);
    $bookMapper = new BookMapper($this->connection);
    $bookMapper->save($book);

    // ACT

    // ASSERT
    $this->assertDatabaseHas('books', [
        'title' => 'A book',
        'year_published' => 1999,
        'author_id' => $author->getId()
    ]);

})->group('integration');


