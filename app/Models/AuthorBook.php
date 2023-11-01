<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    protected $fillable = [
        'book_id',
        'author_id'
    ];

    protected $table = 'author_book';

    public $timestamps = false;
}
