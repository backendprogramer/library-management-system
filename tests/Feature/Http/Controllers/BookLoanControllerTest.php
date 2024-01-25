<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Member;
use Database\Seeders\BookLoanSeeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\MemberSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookLoanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Run seeders using the Artisan command
        $this->seed(BookSeeder::class);
        $this->seed(MemberSeeder::class);
        $this->seed(BookLoanSeeder::class);
    }

    /**
     * @test
     */
    public function it_check_show_all_book_loan_api(): void
    {
        $response = $this->get('/api/bookloan/showall');

        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['status', 'data', 'links'])
            ->where('status', 'success')
            ->whereType('data', 'array')
        );
    }

    /**
     * @test
     */
    public function it_check_add_book_loan_api_error(): void
    {
        $response = $this->post('/api/bookloan/store', ['']);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function it_check_add_book_loan_api_successfully(): void
    {
        $response = $this->post('/api/book/store', ['title' => 'test', 'author' => 'test', 'publish_year' => 1400]);
        $response->assertStatus(200);
        $book = Book::orderBy('id')->first();
        $response = $this->post('/api/member/store', ['name' => 'test', 'email' => 'test@gmail.com']);
        $response->assertStatus(200);
        $member = Member::orderBy('id')->first();

        $response = $this->post('/api/bookloan/store', ['book_id' => $book->id, 'member_id' => $member->id]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_check_update_member_api_successfully(): void
    {
        $this->it_check_add_book_loan_api_successfully();
        $bookLoan = BookLoan::orderBy('id')->first();
        $response = $this->post('/api/bookloan/return/'.$bookLoan->id);
        $response->assertStatus(200);
    }
}
