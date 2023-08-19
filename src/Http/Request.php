<?php

declare(strict_types=1);

namespace App\Http;

class Request
{
    public function __construct(
        private array $queryParams, // $_GET
        private array $serverVars = [], // $_SERVER
        private array $postParams = [], // $_POST
        private array $cookies = [], // $_COOKIE
        private array $files = [] // $_FILES
    )
    {
    }

    public static function createFromGlobals(): self
    {
        return new self(
            $_GET,
            $_SERVER,
            $_POST,
            $_COOKIE,
            $_FILES
        );
    }

    public static function create(
        string $method,
        string $uri,
        array $server = [],
        string $content = ''
    ): self
    {
        $uriParts = parse_url($uri);
        parse_str($uriParts['query'] ?? '', $queryParams);

        $_SERVER['REQUEST_URI'] = $uri;
        $_SERVER['REQUEST_METHOD'] = $method;
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

    public function getMethod(): string
    {
        return $this->serverVars['REQUEST_METHOD'];
    }
}