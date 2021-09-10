<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AuthorsController extends Controller
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
        return view('authors.index')->with('authors', Author::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
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
            'name' => 'required',
            'photo' => 'image|max:2000|nullable'
        ]);
        if ($request->hasFile('photo')) {
            $photo_url = $request->name . '_' . now() . '.' . $request->file('photo')->getClientOriginalExtension();
            if (!$request->file('photo')->storeAs('/authors/photos', $photo_url))
                return back()->withInput()->with('error', 'Oops! Something went wrong during the photo uploading');
        } else
            $photo_url = 'no_photo.png';
        $author = new Author();
        $author->name = $request->name;
        $author->photo = $photo_url;
        if ($author->save())
            return redirect()->route('authors.show', $author->id);
        else
            return back()->withInput()->with('error', 'Oops! Something went wrong, the author was not added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('authors.show')->with('author', Author::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('authors.edit')->with('author', Author::find($id));
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
        $author = Author::find($id);
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'image|max:2000|nullable'
        ]);
        if ($request->hasFile('photo')) {
            $photo_url = $request->name . '_' . now() . '.' . $request->file('photo')->getClientOriginalExtension();
            if (!$request->file('photo')->storeAs('/authors/photos', $photo_url))
                return back()->withInput()->with('error', 'Oops! Something went wrong during the photo uploading');
            else if ($author->photo != 'no_photo.png') if (!File::delete(storage_path('authors/photos/' . $author->photo)))
                return back()->withInput()->with('error', 'the old photo was not deleted');
            $author->photo = $photo_url;
        }
        $author->name = $request->name;
        if ($author->save())
            return redirect()->route('authors.edit', $author->id);
        else
            return back()->withInput()->with('error', 'Oops! Something went wrong, the author was not added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $books = $author->books;

        $booksController = new BooksController();
        foreach($books as $book){
            $booksController->destroy($book->id);
        }
        if($author->photo != 'no_photo.png' && !File::delete(storage_path('authors/photos/'.$author->photo)))
            return back()->with('error', 'the photo was not deleted');
        if (!$author->delete())
            return back()->with('error', 'the author was not deleted');
        return redirect()->route('dashboard')->with('success', 'the author was deleted successfuly');
    }
}
