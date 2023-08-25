<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\JsonResponse;
use App\Http\Response;
use App\Repository\BookRepository;

class BooksController
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function show(int|string $id): JsonResponse
    {
        $book = $this->bookRepository->findById((int) $id);

        return new JsonResponse($book, Response::HTTP_OK);
    }
}