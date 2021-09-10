@extends('layouts.template')

@section('title'){{ 'Dashboard' }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="display-4 py-3 text-center">
            Settings
        </div>
        <div class="row text-center">
            <div class="col-md-10 mx-auto">
                <h4>Admin info</h4>
                <table class="table table-striped table-light table-bordered">
                    <tbody>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                {{ auth('admin')->user()->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email
                            </th>
                            <td>
                                {{ auth('admin')->user()->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Username
                            </th>
                            <td>
                                {{ auth('admin')->user()->username }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Created at
                            </th>
                            <td>
                                {{ auth('admin')->user()->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Updated at
                            </th>
                            <td>
                                {{ auth('admin')->user()->updated_at->diffForHumans() }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Password
                            </th>
                            <td>
                                <a href="{{ route('settings.password') }}" class="btn btn-outline-danger btn-sm">Change Password</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{ route('settings.edit') }}" class="btn btn-success btn-sm">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
