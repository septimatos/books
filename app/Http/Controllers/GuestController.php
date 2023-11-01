<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Book;

class GuestController extends Controller
{
    public function authorsList(Request $request)
    {
        $list = Author::get();

        return response()->json([
            'status' => true,
            'authors' => $list,
        ]);
    }

    public function genresList(Request $request)
    {
        $list = Genre::get();

        return response()->json([
            'status' => true,
            'authors' => $list,
        ]);
    }

    public function booksList(Request $request)
    {
        $list = Book
            ::with('authors')
            ->with('genres')
            ->get();

        return response()->json([
            'status' => true,
            'books' => $list,
        ]);
    }

    public function booksByGenreIdList($id)
    {
        $books = Genre::with('books')->find($id);

        return response()->json([
            'status' => true,
            'books' => $books,
        ]);
    }

    public function booksByAuthorIdList($id)
    {
        $books = Author::with('books')->find($id);

        return response()->json([
            'status' => true,
            'books' => $books,
        ]);
    }
}
