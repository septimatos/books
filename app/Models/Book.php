<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'id',
        'name',
        'avatar',
        'created_at'
    ];

    protected $table = 'books';

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_book');
    }
}
