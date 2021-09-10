@extends('layouts.template')

@section('title'){{ 'Dashboard' }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="row text-center">
            <div class="col-md-10 mx-auto">
                <h1 class="my-2">Change Password</h1>
                <form method="POST">
                    <div class="form-floating mb-3 mx-2">
                        <input type="password" class="form-control bg-dark text-light" id="current_password" placeholder="Current Password" name="current_password"
                            required>
                        <label for="name" class="text-light">Current Password</label>
                    </div>
                    @if ($errors->has('current_password'))
                        <div class="text-danger">
                            {{ $errors->first('current_password') }}
                        </div>
                    @endif
                    <div class="form-floating mb-3 mx-2">
                        <input type="password" class="form-control bg-dark text-light" id="password" placeholder="New Password" name="password"
                            required>
                        <label for="password" class="text-light">New Password</label>
                    </div>
                    @if ($errors->has('password'))
                        <div class="text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <div class="form-floating mb-3 mx-2">
                        <input type="password" class="form-control bg-dark text-light" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation"
                            required>
                        <label for="password_confirmation" class="text-light">Confirm Password</label>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="text-danger">
                            {{ $errors->first('password_confirmation') }}
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
