<?php

namespace App\Http\Services;

use App\Http\Resources\BookLoanResource;
use App\Http\Resources\PaginationCollection;
use App\Jobs\bookLoanJob;
use App\Models\BookLoan;
use Illuminate\Support\Facades\Log;

class BookLoanService {
    
    /**
     * Display a listing of the BookLoans.
     */
    public function showList() {
        try {
            $bookLoans = BookLoan::with('book')->with('member')->paginate(10);
            return $this->returnResponse($bookLoans);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'showList');
        }
    }

    /**
     * Add new BookLoan.
     */
    public function bookLoan($request) {
        Dispatch(new bookLoanJob($request->all()));
        return response()->json([
            'status' => 'success',
            'message' => 'BookLoan request added successfully'
        ]);  
    } 

    /**
     * Update returned BookLoan.
     */
    public function returnBook($bookLoan) {
        try {
            $bookLoan->update(['book_return_date' => now()]);
            return response()->json([
                'status' => 'success',
                'message' => 'BookLoan updated successfully',
                'member' => new BookLoanResource($bookLoan)
            ]);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'edit');
        }
    } 

    /**
     * Response for error catch section
     */
    private function errorResponse($exception, $nameMethode) {
        // Save Erorr In Laravel Log File
        Log::error('error in ' . $nameMethode . 'Book method in BookLoanService: ' . $exception->getMessage() . " \n" . $exception);
        // Return Responce Error
        return response()->json([
            'status' => 'error',
            'message' => 'BookLoan ' . $nameMethode . ' Unsuccessfully!'
        ],500);
    }

    /**
     * Response for showAll and seachBook methods
     */
    private function returnResponse($bookLoans) {
        return response()->json([
            'status' => 'success',
            'data' => BookLoanResource::collection($bookLoans),
            'links' => new PaginationCollection($bookLoans),
        ]);
    }
}