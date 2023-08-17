<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use App\Entity\Book;

class BookMapper
{
    public function __construct(private Connection $connection)
    {
    }

    public function save(Book $book): void
    {
        $stmt = $this->connection->getPdo()->prepare("
            INSERT INTO books (id, title, year_published, author_id)
            VALUES (:id, :title, :year_published, :author_id) 
        ");

        $stmt->bindValue(':id', $book->getId());
        $stmt->bindValue(':title', $book->title);
        $stmt->bindValue(':year_published', $book->yearPublished);
        $stmt->bindValue(':author_id', $book->author->getId());

        $stmt->execute();

        $id = (int) $this->connection->getPdo()->lastInsertId();

        $book->setId($id);
    }
}
