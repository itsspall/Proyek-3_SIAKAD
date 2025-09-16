<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentsController;
use App\Http\Middleware\JwtSessionMiddleware;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class, 'login'])->name('login.post');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

Route::middleware([JwtSessionMiddleware::class])->group(function () {

    Route::get('/me', [UsersController::class, 'me']);
    Route::post('/logout', [UsersController::class, 'logout']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // hanya student
    Route::middleware([JwtSessionMiddleware::class . ':student'])->group(function () {
        Route::get('/courses', [CoursesController::class, 'index']);
        Route::post('/courses/enroll/{id}', [CoursesController::class, 'enroll']);
    });

    // hanya admin
    Route::middleware([JwtSessionMiddleware::class . ':admin'])->group(function () {
        Route::get('/users', [UsersController::class, 'index']);
        Route::resource('/students', StudentsController::class);
        Route::resource('/courses', CoursesController::class);
    });
});
