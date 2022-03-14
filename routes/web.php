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
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('tickets.index');
})->name('tickets');

Route::post('/tickets/{ticket}/comments', 'App\Http\Controllers\CommentsController@store');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tickets', \App\Http\Controllers\TicketController::class);
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
});


Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth'])->name('notifications');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});


