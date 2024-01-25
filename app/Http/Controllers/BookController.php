<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\AddBookRequest;
use App\Http\Requests\Book\SearchBookRequest;
use App\Http\Services\BookService;

class BookController extends Controller
{
    
    public function __construct(private $bookService = new BookService()) {}
    
    /**
     * Display a listing of the Books.
     */
    public function index()
    {
        return $this->bookService->showAll();
    }

    /**
     * Store a newly created Book in storage.
     */
    public function store(AddBookRequest $request)
    {
        return $this->bookService->addBook($request);
    }

    /**
     * Book search by title, author and publish date
     */
    public function search(SearchBookRequest $request)
    {
        return $this->bookService->searchBook($request);
    }

}