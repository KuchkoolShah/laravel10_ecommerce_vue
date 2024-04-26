<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\SizeController;
Route::get('/dashboard', function () {
    return view('admin.index');
});

Route::resource('profile', ProfileController::class);
Route::resource('home_banner', HomeBannerController::class);
Route::get('/manage_size', [SizeController::class ,'index']);
Route::POST('/manage_sizeUpdate', [SizeController::class ,'store']);
