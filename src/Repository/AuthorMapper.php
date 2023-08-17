<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use App\Entity\Author;

class AuthorMapper
{
    public function __construct(private Connection $connection)
    {
    }

    public function save(Author $author): void
    {
        // Prepare the statement
        $stmt = $this->connection->getPdo()->prepare("
            INSERT INTO authors (id, name, bio)
            VALUES (:id, :name, :bio) 
        ");

        // Bind the values
        $stmt->bindValue(':id', $author->getId());
        $stmt->bindValue(':name', $author->name);
        $stmt->bindValue(':bio', $author->bio);

        // Execute
        $stmt->execute();

        // Set the author id
        $lastInsertId = (int) $this->connection->getPdo()->lastInsertId();

        $author->setId($lastInsertId);
    }
}