<?php

namespace App\Repository;

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