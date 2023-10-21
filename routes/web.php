<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {

    # Logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    # Home route
    Route::get('/home',    [HomeController::class, 'index'])->name('home');

    # Admin routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/users',            'index')->name('users');
            Route::get('/users/create',     'create')->name('users.create');
            Route::get('/users/edit/{id}',  'edit')->name('users.edit');
            Route::post('/users',           'store')->name('users.store');
            Route::put('/users/{id}',       'update')->name('users.update');
            Route::delete('/users/{id}',    'destroy')->name('users.destroy');
        });
    });

});