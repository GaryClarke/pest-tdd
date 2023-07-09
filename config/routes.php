<?php

$routes = [
    [
        'GET',
        '/books/{id:\d+}',
        [\App\Controller\BooksController::class, 'show']
    ]
];

return $routes;

