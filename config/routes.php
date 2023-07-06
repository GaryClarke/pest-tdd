<?php

$routes = [
    [
        'GET',
        '/books/{id:\d+}',
        fn() => new \App\Http\Response()
    ]
];

return $routes;

