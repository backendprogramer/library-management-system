<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookLoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'book_id' => $this->book_id,
            'book_title' => $this->book->title,
            'member_id' => $this->member_id,
            'member_name' => $this->member->name,
            'date_borrowed' => $this->created_at,
            'return_date' => $this->book_return_date,
        ];
    }
}