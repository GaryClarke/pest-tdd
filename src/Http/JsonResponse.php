<?php

declare(strict_types=1);

namespace App\Http;

class JsonResponse extends Response
{
    public function __construct(mixed $body, int $statusCode = 200, array $headers = [])
    {
        $body = json_encode($body);
        $headers = array_merge($headers, ['Content-Type' => 'application/json']);

        parent::__construct($body, $statusCode, $headers);
    }
}
