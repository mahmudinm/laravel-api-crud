<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $books->load('author');
        $books->load('category');
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {   
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $fileName = str_random(30).'.'.$image->guessClientExtension();
            $image->move('upload/', $fileName);

            $data['gambar'] = $fileName;
        }

        Book::create($data);
        return response()->json([
            'status' => 'success'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $fileName = str_random(30).'.'.$image->guessClientExtension();
            
            // // Delete gambar yang mau di update
            unlink('upload/'. $book->gambar);

            $image->move('upload/', $fileName);

            $data['gambar'] = $fileName;
        }

        $book->update($data);
        // dd($data);
        return response()->json([
            'status' => 'success'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        unlink('upload/'. $book->gambar);
        $book->delete();
        return response()->json([
            'status' => 'success'
        ], 201);
    }
}
