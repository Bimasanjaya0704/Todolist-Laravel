<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;

// Rute untuk pengguna yang belum login
Route::middleware([\App\Http\Middleware\OnlyGuestMiddleware::class])->group(function () {
    Route::get('/register', [UserController::class, 'showRegistrationForm']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'login']);
    Route::post('/login', [UserController::class, 'doLogin']);
});

// Rute untuk pengguna yang sudah login
Route::middleware([\App\Http\Middleware\OnlyMemberMiddleware::class])->group(function () {
    // Route::get('/todolist', [HomeController::class, 'homePage']);
    Route::post('/logout', [UserController::class, 'doLogout']);
    Route::get('/about', [AboutController::class, 'about']);
});

// route untuk melakukan todo
Route::controller(\App\Http\Controllers\TodolistController::class)
    ->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class])->group(function () {
        Route::get('/todolist', 'todolist');
        Route::post('/todolist', 'addTodolist');
        Route::post('/todolist/{id}/delete', 'deleteTodolist');
        Route::post('/todolist/{id}/finish', 'finishTodo');
    });


// Rute beranda
Route::get('/', [HomeController::class, 'home']);

// Rute untuk tampilan template
Route::view('/template', 'template');
