<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TourController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/tour', [TourController::class, 'getTour']);
Route::get('/restaurant', [RestaurantController::class, 'getRestaurant']);
Route::get('/culture', [CultureController::class, 'getCulture']);
Route::get('/article', [ArticleController::class, 'getArticle']);
Route::get('/job-vacancy', [JobVacancyController::class, 'getJobVacancy']);
