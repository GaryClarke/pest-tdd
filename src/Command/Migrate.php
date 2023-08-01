<?php

namespace App\Command;

class Migrate implements CommandInterface
{
    public function execute(): void
    {
        dd('here!');

        // Obtain PDO

        // Open a try / catch - need to rollback if failures..no half migrated states

        // Begin a transaction

        // Loop through files in migrations folder

            // Include the file

            // Check that it is a Migration

            // Call up method

        // Catch an exception and roll back

            // Throw another exception
    }
}
