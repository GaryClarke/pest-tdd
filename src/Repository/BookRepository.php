<?php

namespace App\Repository;

use App\Entity\Book;

class BookRepository
{
    public function findById(int $id): ?Book
    {
        // Retrieve book data from the database

        // Use it to create and hydrate a Book
        $book = Book::create();

        // return the Book
        return $book;
    }
}