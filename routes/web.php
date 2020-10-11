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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("thoughts", "App\Http\Controllers\ThoughtController");

//rutas para users
Route::get('/users/trash', ['App\Http\Controllers\UserController','trash'])->name('users.trash');
Route::get('/users/{id}/restore', ['App\Http\Controllers\UserController','restore'])->name('users.restore')->where('id', '[0-9]+');
Route::patch('/users/{id}/delete', ['App\Http\Controllers\UserController','delete'])->name('users.delete')->where('id', '[0-9]+');
Route::resource("users", "App\Http\Controllers\UserController");
