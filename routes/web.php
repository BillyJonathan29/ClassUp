<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth')->group(function () {

// });


Route::get('/dashboard', function () {
    return view('layouts.template');
});


Route::redirect('/', 'login');

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'authenticate')->name('login.process');
    Route::get('logout', 'logout')->name('logout');
    Route::get('profile', 'profile')->name('setting.profile');
});
