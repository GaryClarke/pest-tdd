<?php

use App\Entity\Author;
use App\Entity\Book;
use App\Http\JsonResponse;
use App\Repository\AuthorMapper;
use App\Repository\BookMapper;

beforeEach(function() {
    $this->migrateTestDatabase();
});

it('retrieves the correct book data from the books API', function(
    string $uri,
    array $bookData,
    array $authorData
) {
    // ARRANGE
    // Data fixtures
    // Create Author object
    $author = Author::create(
        id: $authorData['id'],
        name: $authorData['name'],
        bio: $authorData['bio']
    );

    // AuthorMapper
    $authorMapper = new AuthorMapper($this->connection);

    // Save Author
    $authorMapper->save($author);

    // Create Book object
    $book = Book::create(
        id: $bookData['id'],
        title: $bookData['title'],
        yearPublished: $bookData['year_published'],
        author: $author
    );

    // BookMapper
    $bookMapper = new BookMapper($this->connection);

    // Save Book
    $bookMapper->save($book);

    // ACT
    $response = $this->json(method: 'GET', uri: $uri);

    // ASSERT
    expect($response->getStatusCode())->toBeInt()->toBe(200)
        ->and($response->getBody())->toMatchJson([
            'id' => $bookData['id'],
            'title' => $bookData['title'],
            'yearPublished' => $bookData['year_published'],
            'author' => [
                'id' => $authorData['id'],
                'name' => $authorData['name'],
                'bio' => $authorData['bio']
            ]
        ]);

    expect($response)->toBeInstanceOf(JsonResponse::class)
        ->and($response->getHeaders())->toMatchArray([
            'Content-Type' =>  'application/json'
        ]);

})->with([
    'book 1' => [
        'uri' => '/books/1',
        'book' => [
            'id' => 1,
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'year_published' => 2008,
        ],
        'author' => [
            'id' => 1,
            'name' => 'Robert C. Martin',
            'bio' => 'This is an author'
        ]
    ],
    'book 2' => [
        'uri' => '/books/2',
        'book' => [
            'id' => 2,
            'title' => 'Refactoring: Improving the Design of Existing Code',
            'year_published' => 1999,
        ],
        'author' => [
            'id' => 2,
            'name' => 'Martin Fowler',
            'bio' => 'Martin\'s bio'
        ],
    ]
])->group('integration');

