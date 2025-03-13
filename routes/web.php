<?php

use App\Http\Controllers\AuthenticationController;
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


Route::get('/', function () {
    return view('layouts.template');
});


Route::get('login', [AuthenticationController::class, 'index'])->name('login');
Route::get('user', [AuthenticationController::class, 'user'])->name('user');
Route::post('store', [AuthenticationController::class, 'authenticate'])->name('login.store');
