<?php


namespace App\Controller;


use App\Http\Response;
use App\Repository\BookRepository;

class BooksController
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function show(int $id): Response
    {
        $book = $this->bookRepository->findById($id);

        return new Response(json_encode($book), Response::HTTP_OK);
    }
}