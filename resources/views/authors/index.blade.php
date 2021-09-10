@extends('layouts.template')

@section('title'){{ 'Authors' }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="display-4 py-3 text-center">
            Authors
        </div>
        <div class="row">
            @if (count($authors) > 0)
                @foreach ($authors as $author)
                    <div class="col-sm-6 my-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-3">
                                    <div class="thumbnail-style">
                                        <div class="square-ratio">
                                            <img src="{{ route('authors.index') }}/photos/{{ $author->photo }}"
                                                alt="{{ $author->name }}"
                                                class="img-fluid img-circle square-ratio-content">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $author->name }}</h5>
                                        <h6 class="card-subtitle text-muted">{{ count($author->books) }}
                                            {{ 'book' }}@if (count($author->books) != 1){{ 's' }}@endif</h6>
                                        <p class="card-text"><a href="{{ route('authors.show', $author->id) }}">View
                                                <i class="fas fa-angle-double-right"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
