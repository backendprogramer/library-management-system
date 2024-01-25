<?php

namespace Tests\Feature\Http\Models;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_create_book(): void
    {
        $book = Book::factory()->create();
        $this->assertModelExists($book);
    }
}