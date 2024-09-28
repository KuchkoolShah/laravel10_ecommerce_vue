<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\ProductController;
Route::get('/dashboard', function () {
    return view('admin.index');
});

Route::resource('profile', ProfileController::class);
Route::resource('home_banner', HomeBannerController::class);
Route::GET('/deleteData/{id}/{table}', [HomeBannerController::class,'deleteData']);
Route::get('/manage_size', [SizeController::class ,'index']);
Route::POST('/manage_sizeUpdate', [SizeController::class ,'store']);

Route::get('/manage_color', [ColorController::class ,'index']);
Route::POST('/manage_colorUpdate', [ColorController::class ,'store']);

Route::get('/attribute_name', [AttributeController::class ,'index_attribute_name']);
Route::POST('/update_attribute_name', [AttributeController::class ,'store_attribute_name']);

Route::get('/attribute_value', [AttributeController::class ,'index_attribute_value']);
Route::POST('/update_attribute_value', [AttributeController::class ,'store_attribute_value']);


Route::get('/category', [CategoryController::class ,'index']);
Route::POST('/categoryUpdate', [CategoryController::class ,'store']);

Route::get('/category_attribute', [CategoryController::class ,'index_category_attribute']);
Route::POST('/category_attribute/update', [CategoryController::class ,'store_category_attribute']);

Route::get('/brand', [BrandController::class ,'index']);
Route::POST('/brand/update', [BrandController::class ,'store']);

Route::get('/tax', [TaxController::class ,'index']);
Route::POST('/tax/update', [TaxController::class ,'store']);

Route::get('/product', [ProductController::class ,'index']);
Route::get('/products/Views/{id?}', [ProductController::class ,'viewProduct']);
Route::post('/getAttributes', [ProductController::class ,'getAttributes']);
Route::post('/product/store', [ProductController::class ,'store']);
