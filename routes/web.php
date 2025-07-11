<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RestaurantController;
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

    Route::prefix('tour')->group(function () {
        Route::get('/', [TourController::class, 'index'])->name('tour');
        Route::post('store', [TourController::class, 'store'])->name('tour.store');
        Route::put('{tour}/update', [TourController::class, 'update'])->name('tour.update');
        Route::get('{tour}/get', [TourController::class, 'get'])->name('tour.get');
        Route::delete('{tour}/destroy', [TourController::class, 'destroy'])->name('tour.destroy');
    });

    Route::prefix('culture')->group(function () {
        Route::get('/', [CultureController::class, 'index'])->name('culture');
        Route::post('store', [CultureController::class, 'store'])->name('culture.store');
        Route::put('{culture}/update', [CultureController::class, 'update'])->name('culture.update');
        Route::get('{culture}/get', [CultureController::class, 'get'])->name('culture.get');
        Route::delete('{culture}/destroy', [CultureController::class, 'destroy'])->name('culture.destroy');
    });

    Route::prefix('article')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('article');
        Route::post('store', [ArticleController::class, 'store'])->name('article.store');
        Route::put('{article}/update', [ArticleController::class, 'update'])->name('article.update');
        Route::get('{article}/get', [ArticleController::class, 'get'])->name('article.get');
        Route::delete('{article}/destroy', [ArticleController::class, 'destroy'])->name('article.destroy');
    });

    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::put('{company}/update', [CompanyController::class, 'update'])->name('company.update');
        Route::get('{company}/get', [CompanyController::class, 'get'])->name('company.get');
        Route::delete('{company}/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');
    });

    Route::prefix('restaurant')->group(function () {
        Route::get('/', [RestaurantController::class, 'index'])->name(('restaurant'));
        Route::post('store', [RestaurantController::class, 'store'])->name(('restaurant.store'));
        Route::put('{restaurant}/update', [RestaurantController::class, 'update'])->name(('restaurant.update'));
        Route::get('{restaurant}/get', [RestaurantController::class, 'get'])->name(('restaurant.get'));
        Route::delete('{restaurant}/destroy', [RestaurantController::class, 'destroy'])->name(('restaurant.destroy'));
    });

    Route::prefix('job-vacancy')->group(function () {
        Route::get('/', [JobVacancyController::class, 'index'])->name('job-vacancy');
        Route::get('create', [JobVacancyController::class, 'create'])->name('job-vacancy.create');
        Route::post('store', [JobVacancyController::class, 'store'])->name('job-vacancy.store');
        Route::get('{jobVacancy}/edit', [JobVacancyController::class, 'edit'])->name('job-vacancy.edit');
        Route::put('{jobVacancy}/update', [JobVacancyController::class, 'update'])->name('job-vacancy.update');
        Route::delete('{jobVacancy}/destroy', [JobVacancyController::class, 'destroy'])->name('job-vacancy.destroy');
    });

    Route::prefix('setting')->group(function () {
        Route::get('change-password', [SettingController::class, 'changePassword'])->name('setting.change_password');
        Route::post('save-password', [SettingController::class, 'savePassword'])->name('setting.save_password');
        Route::get('profile', [SettingController::class, 'profile'])->name('setting.profile');
        Route::post('save-profile', [SettingController::class, 'saveProfile'])->name('setting.save_profile');
    });
});
