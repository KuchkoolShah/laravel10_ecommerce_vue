<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
Route::get('/dashboard', function () {
    return view('admin.index');
});

Route::resource('profile', ProfileController::class);
Route::resource('home_banner', HomeBannerController::class);
Route::get('/manage_size', [SizeController::class ,'index']);
Route::POST('/manage_sizeUpdate', [SizeController::class ,'store']);

Route::get('/manage_color', [ColorController::class ,'index']);
Route::POST('/manage_colorUpdate', [ColorController::class ,'store']);
