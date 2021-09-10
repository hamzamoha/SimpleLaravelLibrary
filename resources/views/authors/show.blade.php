@extends('layouts.template')

@section('title'){{ $author->name }}@endsection

@section('content')
    <div class="m-auto bg-white card col-md-8 p-2">
        <div class="row">
            <div class="col-lg-2 col-sm-3 col-4">
                <div class="thumbnail-style">
                    <div class="square-ratio">
                        <img src="{{ route('authors.index') }}/photos/{{ $author->photo }}"
                            alt="{{ $author->name }}" class="img-fluid img-circle square-ratio-content">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="py-3 text-start">
                    <h1>{{ $author->name }}</h1>
                    <p class="text-muted ps-2">
                        {{ count($author->books) . ' book' }}@if (count($author->books) != 1){{ 's' }}@endif
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row ">
            @if (count($author->books) > 0)
                @foreach ($author->books as $book)
                    <div class="col-lg-3 col-md-4 col-sm-2">
                        <div class="card m-2">
                            <img src="{{route('books.index').'/cover/'.$book->cover}}" class="card-img-top" alt="{{$book->title}}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
