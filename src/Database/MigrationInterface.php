<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

interface MigrationInterface
{
    public function up(PDO $pdo): void;

    public function down(PDO $pdo): void;
}