<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;



Route::view('/', 'home.index')->name('home');

Route::get('/test', TestController::class)->name('test')->middleware('token');


Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'index'])->name('register');

    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


    Route::get('login', [LoginController::class, 'index'])->name('login');

    Route::post('login', [LoginController::class, 'store'])->name('login.store');


    Route::get('/login/google', [LoginController::class, 'redirectToProvider'])->name('login.google')->defaults('provider', 'google');

    Route::get('/login/google/callback', [LoginController::class, 'handleProviderCallback'])->defaults('provider', 'google');


    Route::get('/login/github', [LoginController::class, 'redirectToProvider'])->name('login.github')->defaults('provider', 'github');

    Route::get('/login/github/callback', [LoginController::class, 'handleProviderCallback'])->defaults('provider', 'github');

    //Route::get('login/{user}/confirm', [LoginController::class, 'confirm'])->name('login.confirm');
    //
    //Route::post('login/{user}/confirm', [LoginController::class, 'confirm'])->name('login.confirm');

});



Route::get('blog', [BlogController::class, 'index'])->name('blog');

Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::post('blog/{post}/like', [BlogController::class, 'like'])->name('blog.like');


Route::resource('posts/{post}/comments', CommentController::class);


