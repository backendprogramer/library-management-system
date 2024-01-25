<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookLoan>
 */
class BookLoanFactory extends Factory
{
    private $members;

    private $books;

    public function __construct()
    {
        $this->members = Member::all();
        $this->books = Book::all();
        parent::__construct(); // Call the parent constructor
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'member_id' => $this->members->random()->id,
            'book_id' => $this->books->random()->id,
            'book_return_date' => fake()->dateTimeBetween(),
        ];
    }
}
