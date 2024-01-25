<?php

namespace Database\Seeders;

use App\Models\BookLoan;
use Illuminate\Database\Seeder;

class BookLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookLoan::factory(10000)->create();
    }
}
