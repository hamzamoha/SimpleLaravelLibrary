@extends('layouts.template')

@section('title'){{ 'Dashboard' }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="row text-center">
            <div class="col-md-10 mx-auto">
                <h1 >Admin info</h1>
                <form method="POST" autocomplete="off">
                    <div class="form-floating mb-3 mx-2">
                        <input type="text" class="form-control bg-dark text-light" id="name" placeholder="Name" name="name"
                            required value="{{ auth('admin')->user()->name }}">
                        <label for="name" class="text-light">Name</label>
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <div class="form-floating mb-3 mx-2">
                        <input type="email" class="form-control bg-dark text-light" id="email" placeholder="Email" name="email"
                            required value="{{ auth('admin')->user()->email }}">
                        <label for="email" class="text-light">Email</label>
                    </div>
                    @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="form-floating mb-3 mx-2">
                        <input type="text" class="form-control bg-dark text-light" id="username" placeholder="Name" name="username"
                            required value="{{ auth('admin')->user()->username }}">
                        <label for="username" class="text-light">Username</label>
                    </div>
                    @if ($errors->has('username'))
                        <div class="text-danger">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                    <div class="mb-3 mx-2">
                        <input type="submit" value="Update" class="btn btn-success btn-sm">
                        <a href="{{ route('settings') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    </div>
                    @csrf
                    @method('PUT')
                </form>
            </div>
        </div>
    </div>
@endsection
