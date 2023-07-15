<?php


namespace App\Controller;


use App\Http\Response;

class BooksController
{
    public function show(int $id): Response
    {
        $book = [];

        if ($id === 1) {
            $book = [
                'id' => 1,
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'year_published' => 2008,
                'author' => [
                    'id' => 1,
                    'name' => 'Robert C. Martin',
                    'bio' => 'This is an author'
                ]
            ];
        }

        if ($id === 2) {
            $book = [
                'id' => 2,
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'yearPublished' => 1999,
                'author' => [
                    'id' => 2,
                    'name' => 'Martin Fowler',
                    'bio' => 'Martin\'s bio'
                ]
            ];
        }

        return new Response(json_encode($book), Response::HTTP_OK);
    }
}