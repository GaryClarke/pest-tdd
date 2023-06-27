<?php

namespace App\Http;

class Request
{
    public function __construct(
        private array $queryParams, // $_GET
    )
    {
    }

    public static function create(
        string $method,
        string $uri,
        iterable $server,
        string $content
    ): self
    {
        $uriParts = parse_url($uri);
        parse_str($uriParts['query'] ?? '', $queryParams);

        return new self(
            $queryParams
        );
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }
}