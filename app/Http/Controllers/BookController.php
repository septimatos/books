<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Book::get();

        return response()->json([
            'status' => true,
            'books' => $list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'avatar' => 'required|string',
            'authors' => 'required|array',
            'genres' => 'required|array',
        ]);

        $book = new Book;
        $book->name = $request->name;
        $book->avatar = $request->avatar;
        $book->save();

        $book->authors()->attach($request->authors);
        $book->genres()->attach($request->genres);

        return response()->json([
            'status' => true,
            'author' => $book,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'avatar' => 'required|string',
            'authors' => 'required|array',
            'genres' => 'required|array',
        ]);

        $book = Book::find($id);
        $book->name = $request->name;
        $book->avatar = $request->avatar;
        $book->save();

        $book->authors()->sync($request->authors);
        $book->genres()->sync($request->genres);

        return response()->json([
            'status' => true,
            'author' => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
