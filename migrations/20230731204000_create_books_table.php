<?php

use App\Database\MigrationInterface;

return new class implements MigrationInterface
{
    public function up(PDO $pdo): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS books (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            year_published INTEGER,
            author_id INTEGER,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (author_id) REFERENCES authors(id)
        );";

        $pdo->exec($sql);
    }

    public function down(PDO $pdo): void
    {
        $sql = "DROP TABLE IF EXISTS books;";

        $pdo->exec($sql);
    }
};

