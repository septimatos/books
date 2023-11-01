<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenreBook extends Model
{
    protected $fillable = [
        'book_id',
        'genre_id'
    ];

    protected $table = 'genre_book';

    public $timestamps = false;
}
