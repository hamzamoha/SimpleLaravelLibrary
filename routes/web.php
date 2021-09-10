<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'index'])->name('home');

//admin
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'postLogin']);
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
Route::get('/settings/edit', [AdminController::class, 'edit'])->name('settings.edit');
Route::put('/settings/edit', [AdminController::class, 'update']);
Route::get('/settings/password', [AdminController::class, 'editPassword'])->name('settings.password');
Route::put('/settings/password', [AdminController::class, 'updatePassword']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

//Resource
Route::resource('books', BooksController::class);
Route::resource('authors', AuthorsController::class);

//files
Route::get('/authors/photos/{url}', [FilesController::class, 'getPhoto']);
Route::get('/books/cover/{url}', [FilesController::class, 'getCover']);
Route::get('/books/pdf/{url}', [FilesController::class, 'getPDF']);