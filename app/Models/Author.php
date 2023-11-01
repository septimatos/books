<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'created_at'
    ];

    protected $table = 'authors';

    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }


}
