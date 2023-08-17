<?php

declare(strict_types=1);

namespace App\Entity;

class Book implements \JsonSerializable
{
    public function __construct(
        private ?int $id,
        public readonly string $title,
        public readonly int $yearPublished,
        public Author $author
    )
    {
    }

    public static function create(?int $id, string $title, int $yearPublished, Author $author): self
    {
        return new self($id, $title, $yearPublished, $author);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}