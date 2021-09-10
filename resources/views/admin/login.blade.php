@extends('layouts.template')

@section('title'){{ 'Login' }}@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-lg-6 col-xl-5 offset-xl-1 my-lg-5 py-lg-5 text-center mx-auto bg-white border">
            <form autocomplete="off" method="POST">
                <div class="mb-3">
                    <h2>
                        Login
                    </h2>
                </div>
                <div class="form-floating mb-3 mx-2">
                    <input type="text" class="form-control bg-dark text-light" id="username" placeholder="Username"
                        name="username" required value="{{ old('username') }}">
                    <label for="username" class="text-light">Username</label>
                </div>
                @if ($errors->has('username'))
                    <div class="text-danger">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <div class="form-floating mb-3 mx-2">
                    <input type="password" class="form-control bg-dark text-light" id="password" placeholder="Password"
                        name="password" required>
                    <label for="password" class="text-light">Password</label>
                </div>
                @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="mb-4 mx-2">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <div class="mb-4 mx-2">
                    <button class="btn btn-dark" type="submit">Submit form</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
@endsection
