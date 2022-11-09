<?php

namespace App\Http\Controllers;

use App\Models\book;
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
        return view('layouts.management.form.add-book');
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
            'code' => $request->code,
            'title' => $request->title,
            'cover' => '',
            'writer' => $request->writer,
            'status' => '0',
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
