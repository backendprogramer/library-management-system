<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLoan extends Model
{
    use HasFactory;

    /**
     * Fields
     *
     * @var string[]
     */
    protected $fillable = ['book_id', 'member_id', 'book_return_date'];

    // Accessor for the book_return_date attribute
    public function getbookReturnDateAttribute($value)
    {
        if (isset($value)) {
            // Convert the timestamp to a datetime format using Carbon
            return Carbon::parse($value)->toDateTimeString();
        }

        return null;
    }

    // Accessor for the created_at attribute
    public function getCreatedAtAttribute($value)
    {
        // Convert the timestamp to a datetime format using Carbon
        return Carbon::parse($value)->toDateTimeString();
    }

    /**
     * get book data
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    /**
     * get member data
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }
}
