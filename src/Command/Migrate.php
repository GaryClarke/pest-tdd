<?php

namespace App\Command;

use App\Database\Connection;
use PDOException;

class Migrate implements CommandInterface
{
    public function __construct(
        private Connection $connection,
        private string $migrationsFolder
    )
    {
    }

    public function execute(): void
    {
        // Obtain PDO
        $pdo = $this->connection->getPdo();

        // Open a try / catch - need to rollback if failures..no half migrated states
        try {

            // Begin a transaction
            $pdo->beginTransaction();

            $files = scandir($this->migrationsFolder);

            // Loop through files in migrations folder

                // Include the file

                // Check that it is a Migration

                // Call up method

        // Catch an exception and roll back
        } catch (PDOException $exception) {

            // Rollback transaction
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            // Throw another exception
            throw $exception;
        }
    }
}
