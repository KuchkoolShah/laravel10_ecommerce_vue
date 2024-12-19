<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\HomePageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/auth/login', [LoginController::class, 'loginUser']);
// Route::post('/auth/register', [LoginController::class, 'register']);
// Route::post('/auth/logout', [LoginController::class, 'logout']);

//HomeController
Route::get('/getHomeData', [HomePageController::class, 'getHomeData']);
Route::get('/getHeadercategoriesData', [HomePageController::class, 'getCategories']);
