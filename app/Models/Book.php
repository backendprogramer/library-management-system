<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    /**
     * Fields
     * @var string[]
     */
    protected $fillable = ['title', 'author', 'publish_year'];
}