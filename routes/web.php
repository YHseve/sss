<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

Auth::routes();


Route::get('/', [BlogController::class, 'index'])->name('home');
Route::resource('blogs', BlogController::class)->middleware('auth');
Route::post('blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::get('/welcome', function () {return view('welcome');});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
