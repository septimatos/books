<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'id',
        'name',
        'created_at'
    ];

    protected $table = 'genres';

    public function books()
    {
        return $this->belongsToMany(Book::class, 'genre_book');
    }
}
