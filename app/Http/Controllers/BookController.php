<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataBuku = Book::all();
        return view('layouts.management.book', ['dataBuku' => $dataBuku]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataKategori = Category::all();
        return view('layouts.management.form.add-book', ['dataKategori' => $dataKategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Book::create([
            'category_id' => $request->category_id,
            'code' => $request->code,
            'title' => $request->title,
            'cover' => '',
            'writer' => $request->writer,
            'stock' => $request->stock,
            'being_borrowed' => 0,
            'price' => $request->price
        ]);
        return redirect('book');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editBuku = Book::findOrFail($id);
        return view('layouts.management.form.update-book', ['editBuku' => $editBuku]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateBuku = Book::findOrFail($id);
        $updateBuku->update([
            'code' => $request->code,
            'title' => $request->title,
            'writer' => $request->writer,
            'stock' => $request->stock,
            'price' => $request->price
        ]);
        return redirect('book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteKategori = Book::findOrFail($id);
        $deleteKategori->delete();
        return redirect()->back()->with('message', 'Delete successfully');
    }
}
