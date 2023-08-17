<?php

declare(strict_types=1);

namespace App\Entity;

use JetBrains\PhpStorm\Internal\TentativeType;

class Author implements \JsonSerializable
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
