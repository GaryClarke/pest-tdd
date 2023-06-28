<?php

namespace App\Http;

class Request
{
    public function __construct(
        private array $queryParams, // $_GET
        private array $serverVars = []
    )
    {
    }

    public static function create(
        string $method,
        string $uri,
        array $server,
        string $content
    ): self
    {
        $uriParts = parse_url($uri);
        parse_str($uriParts['query'] ?? '', $queryParams);

        $_SERVER['REQUEST_URI'] = $uri;
        $serverVars = array_merge($server, $_SERVER);

        return new self(
            $queryParams,
            $serverVars
        );
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPath(): string
    {
        return strtok($this->serverVars['REQUEST_URI'], '?');
    }
}