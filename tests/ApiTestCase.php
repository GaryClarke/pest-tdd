<?php

namespace Tests;

use App\Http\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class ApiTestCase extends BaseTestCase
{
    public function json(
        string $method = 'GET',
        string $uri = '/',
        array $data = [],
        array $headers = []
    ): Response
    {
        // Json encode the data

        // Merge server variables with $headers

        // Create a $request using a static named constructor

        // Create / resolve the Kernel

        // Obtain a $response object: $response = $kernel->handle($request)

        // return the $response

        $body = '{"id":1,"title":"Clean Code: A Handbook of Agile Software Craftsmanship","year_published":2008,"author":{"id":1,"name":"Robert C. Martin","bio":"This is an author"}}';

        return new Response(body: $body, statusCode: 200, headers: []);
    }
}
