@extends('layouts.template')

@section('title'){{ 'Edit: ' . $author->name }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="h2 text-center py-3">Edit: {{ $author->name }}</i></div>
        <form autocomplete="off" method="POST" action="{{ route('authors.update', $author->id) }}"
            enctype="multipart/form-data">
            <div class="form-floating mb-3 mx-2">
                <input type="text" class="form-control bg-dark text-light" id="name" placeholder="Name" name="name" required
                    value="{{ $author->name }}">
                <label for="name" class="text-light">Name</label>
            </div>
            @if ($errors->has('name'))
                <div class="text-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mx-auto mb-3 text-center square-ratio">
                <div class="square-ratio-content">
                    <img src="{{ route('authors.index') . '/photos/' . $author->photo }}" alt="" class="img-thumbnail">
                </div>
            </div>
            <div class="input-group mb-3 mx-2 w-auto">
                <input type="file" class="form-control form-control-sm" id="photo" name="photo">
                <label class="input-group-text btn btn-success btn-sm text-light" for="photo">Photo</label>
            </div>
            @if ($errors->has('photo'))
                <div class="text-danger">
                    {{ $errors->first('photo') }}
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
