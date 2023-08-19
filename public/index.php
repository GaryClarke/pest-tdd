<?php

use App\Http\Kernel;
use App\Http\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$container = include dirname(__DIR__) . '/config/services.php';

// Create a $request using a static named constructor
$request = Request::createFromGlobals();

// Create a Http/Kernel (the heart of the application)
$kernel = $container->get(Kernel::class);

// Call the handle method on the Kernel, passing in the Request..
//the handle method returns our treasured Response
// so $response = $kernel->handle($request);
$response = $kernel->handle($request);

// send back content
$response->send();

