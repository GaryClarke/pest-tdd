<?php

use App\Entity\Author;

uses(\Tests\ApiTestCase::class);

it('saves an Author to the database', function() {

    // ARRANGE
    // Create $author and $authorMapper
    $author = Author::create(null, 'Alan Turing', 'A math genius');
    $authorMapper = new AuthorMapper($this->connection);

    // ACT
    // Save the author
    $authorMapper->save($author);

    // ASSERT
    // Assert that it is in the database
    $this->assertDatabaseHas('authors', [
        'name' => 'Alan Turing',
        'bio' => 'A math genius'
    ]);
});