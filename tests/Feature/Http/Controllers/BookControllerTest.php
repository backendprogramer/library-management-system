<?php

namespace Tests\Feature\Http\Controllers;

use Database\Seeders\BookSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Run seeders using the Artisan command
        $this->seed(BookSeeder::class);
    }

    /**
     * @test
     */
    public function it_check_show_all_book_api(): void
    {
        $response = $this->get('/api/book/showall');

        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['status', 'data', 'links'])
            ->where('status', 'success')
            ->whereType('data', 'array')
        );
    }

    /**
     * @test
     */
    public function it_check_add_book_api_error(): void
    {
        $response = $this->post('/api/book/store');
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function it_check_add_book_api_successfully(): void
    {
        $response = $this->post('/api/book/store', ['title' => 'test', 'author' => 'test', 'publish_year' => 1400]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_check_search_book_api(): void
    {
        $response = $this->get('/api/book/search', ['title' => 'test']);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['status', 'data', 'links'])
            ->where('status', 'success')
            ->whereType('data', 'array')
        );
    }
}
