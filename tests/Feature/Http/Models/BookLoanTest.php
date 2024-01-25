<?php

namespace Tests\Feature\Http\Models;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Member;
use Tests\TestCase;

class BookLoanTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_create_book_loan(): void
    {
        Book::factory()->create();
        Member::factory()->create();
        $bookLoan = BookLoan::factory()->create();
        $this->assertModelExists($bookLoan);
    }
}