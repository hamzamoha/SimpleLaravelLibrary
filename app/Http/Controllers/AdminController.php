<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('login', 'postLogin');
        $this->middleware('guest:admin')->only('login', 'postLogin');
    }
    public function login()
    {
        return view('admin.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:admin',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt($request->only('username', 'password'), $request->remember)) {
            return redirect()->route('dashboard');
        }
        return back()->withInput()->with('error', 'Your information are not correct');
    }
    public function dashboard()
    {
        return view('admin.dashboard')->with([
            'books' => Book::orderBy('title')->get(),
            'authors' => Author::orderBy('name')->get(),
        ]);
    }
    public function settings()
    {
        return view('admin.settings');
    }
    public function edit()
    {
        return view('admin.edit');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin,email,' . auth('admin')->user()->id,
            'username' => 'required|max:255|unique:admin,email,' . auth('admin')->user()->id,
        ]);

        $admin = Admin::find(auth('admin')->user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->save();

        return redirect()->route('settings')->with('success', 'Done!');
    }
    public function editPassword()
    {
        return view('admin.password');
    }
    public function updatePassword(Request $request)
    {
        $admin = Admin::find(auth('admin')->user()->id);
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        if (Hash::check($request->current_password, $admin->password)) {
            $admin->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return redirect()->route('settings')->with('success', 'The password was changed successfuly');
        } else {
            return back()->with('error', 'the password is not correct');
        }
    }
    public function logout(Request $request)
    {
        auth('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
