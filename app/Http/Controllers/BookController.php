<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //get posts
        $books = Book::latest()->paginate(5);

        //render view with posts
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'title'     => 'required|min:5',
            'author'   => 'required|min:5'
        ]);

        Book::create([
            'title'     => $request->title,
            'author'   => $request->author
        ]);

        //redirect to index
        return redirect()->route('book.index')->with(['success' => 'Data successfully saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        //render view with post
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        //render view with post
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $this->validate($request, [
            'title'     => 'required|min:5',
            'author'   => 'required|min:5'
        ]);

        $book->update([
            'title'     => $request->title,
            'author'   => $request->author
        ]);

        //redirect to index
        return redirect()->route('book.index')->with(['success' => 'Data successfully saved!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
