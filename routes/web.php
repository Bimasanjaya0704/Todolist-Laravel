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

Route::get('/', function () {
    return view('welcome');
});

route::view('/template','template');

route::controller(\App\Http\Controllers\UserController::class)
    ->group(function()
        {
            route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
            route::post('/login','doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
            Route::post('/logout','doLogout')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
        });