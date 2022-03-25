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
    Route::resource('notifications', \App\Http\Controllers\NotificationController::class);
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::resource('tickets', \App\Http\Controllers\TicketController::class);
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
    Route::get('activity-logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});

Route::get('tickets/restore/{id}', [\App\Http\Controllers\TicketController::class, 'restore'])->name('tickets.restore');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


