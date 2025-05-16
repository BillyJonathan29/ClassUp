<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TourController;
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




Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('{user}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('tour')->group(function(){
        Route::get('/', [TourController::class, 'index'])->name('tour');
        Route::post('store', [TourController::class, 'store'])->name('tour.store');
        Route::delete('{tour}/destroy', [TourController::class, 'destroy'])->name('tour.destroy');
    });

    Route::prefix('setting')->group(function () {
        Route::get('change-password', [SettingController::class, 'changePassword'])->name('setting.change_password');
        Route::post('save-password', [SettingController::class, 'savePassword'])->name('setting.save_password');
        Route::get('profile', [SettingController::class, 'profile'])->name('setting.profile');
        Route::post('save-profile', [SettingController::class, 'saveProfile'])->name('setting.save_profile');
    });
});
