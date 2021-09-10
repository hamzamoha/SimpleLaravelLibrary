@extends('layouts.template')

@section('title'){{ 'Books' }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="display-4 py-3 text-center">
            Books
        </div>
        <div class="row">
            @if (count($books) > 0)
            @foreach ($books as $book)
                <div class="col-xl-15 col-lg-3 col-md-4 col-sm-6">
                    <div class="card m-2">
                        <img src="{{route('books.index').'/cover/'.$book->cover}}" class="card-img-top" alt="{{$book->title}}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">by <a href="{{ route('authors.show', $book->author_id) }}">{{ $book->author->name }}</a></p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
@endsection
