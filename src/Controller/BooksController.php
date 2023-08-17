<?php

declare(strict_types=1);

namespace App\Controller;


use App\Http\Response;
use App\Repository\BookRepository;

class BooksController
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function show(int|string $id): Response
    {
        $book = $this->bookRepository->findById((int) $id);

        return new Response(json_encode($book), Response::HTTP_OK);
    }
}