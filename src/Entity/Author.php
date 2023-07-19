<?php

namespace App\Entity;

class Author
{
    public function __construct(
        private ?int $id,
        public readonly string $name,
        public readonly string $bio,
    )
    {
    }

    public static function create(?int $id, string $name, string $bio): self
    {
        return new self($id, $name, $bio);
    }
}
