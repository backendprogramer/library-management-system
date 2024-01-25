<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookLoan\StoreBookLoanRequest;
use App\Http\Services\BookLoanService;
use App\Models\BookLoan;

class BookLoanController extends Controller
{

    public function __construct(private $bookLoanService = new BookLoanService()) {}
    
    /**
     * Display a listing of books borrowed by members
     */
    public function index()
    {
        return $this->bookLoanService->showList();
    }


    /**
     * Store the borrowed book
     */
    public function store(StoreBookLoanRequest $request)
    {
        return $this->bookLoanService->bookLoan($request);
    }


    /**
     * Update the borrowed book in storage.
     */
    public function update(BookLoan $bookLoan)
    {
        return $this->bookLoanService->returnBook($bookLoan);
    }
}