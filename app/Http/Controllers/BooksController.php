<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index')->with('books', Book::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('books.create')->with('authors', $authors);
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
            'title' => 'required',
            'author' => 'required',
            'pdf' => 'nullable|mimes:pdf',
            'cover' => 'image|nullable'
        ]);
        if ($request->hasFile('pdf')) {
            $pdf = $request->title . '_' . now() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $request->file('pdf')->storeAs('/books/pdf', $pdf);
        } else $pdf = null;
        if ($request->hasFile('cover')) {
            $cover = $request->title . '_' . now() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $request->file('cover')->storeAs('/books/cover', $cover);
        } else $cover = 'no_cover.png';
        $book = new Book();
        $book->title = $request->title;
        $book->author_id = $request->author;
        if ($pdf) $book->pdf = $pdf;
        if ($cover) $book->cover = $cover;
        if ($book->save())
            return redirect()->route('authors.show', $book->author_id)->with('success', 'the book was added successfuly');
        else
            return back()->withInput()->with('error', 'the book was not added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('books.show')->with('book', Book::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('books.edit')->with([
            'book' => Book::find($id),
            'authors' => Author::orderBy('name')->get(),
        ]);
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
        $book = Book::find($id);
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'pdf' => 'nullable|mimes:pdf',
            'cover' => 'image|nullable'
        ]);
        if ($request->hasFile('pdf')) {
            $pdf = $request->title . '_' . now() . '.' . $request->file('pdf')->getClientOriginalExtension();
            if (!$request->file('pdf')->storeAs('/books/pdf', $pdf))
                return back()->with('error', 'the pdf was not uploaded');
            if ($book->pdf) if (!File::delete(storage_path('books/pdf/' . $book->pdf)))
                return back()->with('error', 'the old pdf was not deleted');
            $book->pdf = $pdf;
        }
        if ($request->hasFile('cover')) {
            $cover = $request->title . '_' . now() . '.' . $request->file('cover')->getClientOriginalExtension();
            if (!$request->file('cover')->storeAs('/books/cover', $cover))
                return back()->with('error', 'the cover was not uploaded');
            if ($book->cover != 'no_cover.png') if (!File::delete(storage_path('books/cover/' . $book->cover)))
                return back()->with('error', 'the old cover was not deleted');
            $book->cover = $cover;
        }
        $book->title = $request->title;
        $book->author_id = $request->author;
        if ($book->save())
            return redirect()->route('books.edit', $book->id);
        else
            return back()->withInput()->with('error', 'the book was not added');
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
        if ($book->cover != 'no_cover.png' &&  !File::delete(storage_path('books/cover/' . $book->cover)))
            return back()->with('error', 'the cover was not deleted');
        if ($book->pdf && !File::delete(storage_path('books/pdf/' . $book->pdf)))
            return back()->with('error', 'the pdf was not deleted');
        if (!Book::find($id)->delete())
            return back()->with('error', 'the book was not deleted');
        return redirect()->route('dashboard')->with('success', 'the book was deleted successfuly');
    }
}
