@extends('layouts.template')

@section('title'){{ $book->title . ' by ' . $book->author->name }}@endsection

@section('content')
    <div class="m-auto bg-white card col-md-8 p-2">
        <div class="row mb-5">
            <div class="col-lg-2 col-sm-3 col-4">
                <div class="thumbnail-style">
                    <div class="square-ratio">
                        <img src="{{ route('books.index') }}/cover/{{ $book->cover }}" alt="{{ $book->title }}"
                            class="img-fluid img-circle square-ratio-content">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="py-3 text-start">
                    <h1>{{ $book->title }}</h1>
                    <p class="text-muted ps-2">
                        by {{ $book->author->name }}
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-2 px-2">
            <h4>Summary</h4>
            <p class="text-indent-2">
                The rain and wind abruptly stopped, but the sky still had the gray swirls of storms in the distance. Dave
                knew this feeling all too well. The calm before the storm. He only had a limited amount of time before all
                Hell broke loose, but he stopped to admire the calmness. Maybe it would be different this time, he thought,
                with the knowledge deep within that it wouldn't.
            </p>
        </div>
        <div class="mb-2 px-2">
            <h4>Download</h4>
            <div class="text-center">
                @if ($book->pdf)
                <a href="{{ route('books.index').'/pdf/'.$book->pdf }}" class="btn btn-success text-light">
                    Download
                </a>
                @else
                    <button class="btn btn-dark border" disabled>no PDF available</button>
                @endif
                
            </div>
        </div>
    </div>
@endsection
