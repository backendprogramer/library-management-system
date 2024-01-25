<?php

namespace App\Http\Services;

use App\Http\Resources\BookResource;
use App\Http\Resources\PaginationCollection;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookService
{
    /**
     * Display a listing of the Books.
     */
    public function showAll()
    {
        try {
            $books = Book::paginate(10);

            return $this->returnResponse($books);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'showAll');
        }
    }

    /**
     * Store a newly created Book in storage.
     */
    public function addBook($request)
    {
        try {
            $book = Book::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Book added successfully',
                'book' => new BookResource($book),
            ]);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'add');
        }
    }

    /**
     * Book search by name, author and publication date
     */
    public function searchBook($request)
    {
        try {
            $book = Book::query();

            $fields = ['title', 'author', 'publish_date'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $book = Book::where($field, 'like', '%'.$request->get($field).'%');
                }
            }

            $books = $book->paginate(10);

            return $this->returnResponse($books);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'search');
        }
    }

    /**
     * Response for error catch section
     */
    private function errorResponse($exception, $nameMethode)
    {
        // Save Erorr In Laravel Log File
        Log::error('error in '.$nameMethode.'Book method in BookService: '.$exception->getMessage()." \n".$exception);

        // Return Responce Error
        return response()->json([
            'status' => 'error',
            'message' => 'Book '.$nameMethode.' Unsuccessfully!',
        ], 500);
    }

    /**
     * Response for showAll and seachBook methods
     */
    private function returnResponse($books)
    {
        return response()->json([
            'status' => 'success',
            'data' => BookResource::collection($books),
            'links' => new PaginationCollection($books),
        ]);
    }
}
