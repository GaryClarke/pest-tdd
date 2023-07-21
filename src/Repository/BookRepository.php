<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Book;

class BookRepository
{
    public function findById(int $id): ?Book
    {
        // Retrieve book data from the database
        $row = [
            'id' => 999,
            'title' => 'A Test Book',
            'year_published' => 1999,
            'author_id' => 123,
            'author_name' => 'A. N. Author',
            'author_bio' => 'This is an author'
        ];

        $author = Author::create(
            id: $row['author_id'],
            name: $row['author_name'],
            bio: $row['author_bio']
        );

        // Use it to create and hydrate a Book
        $book = Book::create(
            id: $row['id'],
            title: $row['title'],
            yearPublished: $row['year_published'],
            author: $author
        );

        // return the Book
        return $book;
    }
}