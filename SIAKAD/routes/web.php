<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/login', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class, 'login'])->name('login.post');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->name('home');
