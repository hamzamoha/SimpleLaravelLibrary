@extends('layouts.template')

@section('title'){{ 'Edit: ' . $book->title }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="h2 text-center py-3">Edit: {{ $book->title }}</div>
        <form autocomplete="off" method="POST" action="{{ route('books.update', $book->id) }}"
            enctype="multipart/form-data">
            <div class="form-floating mb-3 mx-2">
                <input type="text" class="form-control bg-dark text-light" id="title" placeholder="Title" name="title"
                    required value="{{ $book->title }}">
                <label for="title" class="text-light">Title</label>
            </div>
            @if ($errors->has('title'))
                <div class="text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
            <div class="input-group mb-3 mx-2 w-auto">
                <label class="input-group-text border-dark bg-white" for="name">Author</label>
                <select class="form-select bg-dark text-light border-dark" id="author" name="author">
                    @if (count($authors) > 0)
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" @if ($book->author_id == $author->id)
                                {{ 'selected' }}
                        @endif>{{ $author->name }}</option>
                    @endforeach
                    @endif
                </select>
                <a class="btn btn-outline-dark border-dark" role="button" href="{{ route('authors.create') }}"><i
                        class="fas fa-plus"></i></a>
            </div>
            @if ($errors->has('author'))
                <div class="text-danger">
                    {{ $errors->first('author') }}
                </div>
            @endif
            @if ($book->pdf)
                <div class="mb-3 mx-2 w-auto">
                    PDF: <a href="{{ route('books.index') . '/pdf/' . $book->pdf }}">{{ $book->pdf }}</a>
                </div>
            @else
                <div class="mb-3 mx-2 w-auto ps-2 text-danger">
                    <i class="fas fa-times"></i> no PDF available
                </div>
            @endif
            <div class="input-group mb-3 mx-2 w-auto">
                <input type="file" class="form-control form-control-sm" id="pdf" name="pdf">
                <label class="input-group-text btn btn-danger btn-sm text-light" for="pdf">PDF</label>
            </div>
            @if ($errors->has('pdf'))
                <div class="text-danger">
                    {{ $errors->first('pdf') }}
                </div>
            @endif
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mx-auto mb-3 text-center square-ratio">
                <div class="square-ratio-content">
                    <img src="{{ route('books.index') . '/cover/' . $book->cover }}" alt=""
                        class="img-thumbnail square-ratio-content-contain">
                </div>
            </div>
            <div class="input-group mb-3 mx-2 w-auto">
                <input type="file" class="form-control form-control-sm" id="cover" name="cover">
                <label class="input-group-text btn btn-success btn-sm text-light" for="cover">Cover</label>
            </div>
            @if ($errors->has('cover'))
                <div class="text-danger">
                    {{ $errors->first('cover') }}
                </div>
            @endif
            <div class="mb-4 mx-2">
                <button class="btn btn-dark" type="submit">Update</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
            @csrf
            @method('PUT')
        </form>
    </div>
@endsection
