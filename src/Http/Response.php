<?php

declare(strict_types=1);

namespace App\Http;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_METHOD_NOT_ALLOWED = 405;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    public function __construct(
        private string $body = '',
        private int $statusCode = 200,
        private iterable $headers = []
    )
    {
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function send(): void
    {
        // start output buffering
        ob_start();

        // send headers
        foreach ($this->headers as $key => $value) {
            header("$key: $value"); // e.g. "Content-Type: application/json";
        }

        // This will actually add the content to the buffer
        echo $this->body;

        // Flush the buffer, sending the content to the client
        ob_end_flush();
    }

    public function getheaders(): array
    {
        return $this->headers;
    }
}
