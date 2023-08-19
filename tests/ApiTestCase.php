<?php

namespace Tests;

use App\Command\Migrate;
use App\Database\Connection;
use App\Database\Database;
use App\Http\Kernel;
use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;
use League\Container\Container;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class ApiTestCase extends BaseTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        $this->container = include dirname(__DIR__) . '/config/services.php';
        $this->connection = $this->container->get(Connection::class);
    }

    public function json(
        string $method = 'GET',
        string $uri = '/',
        array $data = [],
        array $headers = []
    ): Response
    {
        // Json encode the data
        $content = json_encode($data);

        // Merge server variables with $headers
        $server = array_merge([
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ], $headers);

        // Create a $request using a static named constructor
        $request = Request::create(
            method: $method,
            uri: $uri,
            server: $server,
            content: $content
        );

        // Create / resolve the Kernel
        $kernel = $this->container->get(Kernel::class);

        // Obtain a $response object: $response = $kernel->handle($request)
        $response = $kernel->handle($request);

        // return the $response
        return $response;
    }

    public function migrateTestDatabase(): void
    {
        $connection = $this->container->get(Connection::class);
        $migrationsFolder = $this->container->get('migrations_folder');

        $migrate = new Migrate($connection, $migrationsFolder);

        $migrate->execute();
    }

    public function assertDatabaseHas(string $tablename, array $criteria): void
    {
        // Instantiate a DB object which can be used to query any table
        $db = new Database($this->connection);

        // Fetch records from $tablename which match the supplied $criteria
        $result = $db->fetchRecords($tablename, $criteria);

        // Assert that at least one record was found
        $this->assertGreaterThan(0, count($result));
    }
}
