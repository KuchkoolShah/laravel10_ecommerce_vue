<?php

use Illuminate\Support\Facades\Route;
use App\Models\Role;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Auth\LoginController;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
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
    return redirect('admin/dashboard');
});

Route::get('/login', function () {
  return view('auth.singIn');
});


Route::get('/apiDoc', function () {
  return view('index');
});

Route::GET('/create/admin' ,[AuthController::class,'createCustomer']);
Route::GET('login/admin' ,[AuthController::class,'ShowLoginForm']);
Route::POST('login/admin' ,[LoginController::class,'loginUser']);
// Route::GET('/api-doc' ,[HomeController::class,'index']);
Route::get('/createRole', function () {
   $role         =  new Role();
   $role->name   =  'Customer';
  $role->slug   =  'customer';
  $role->save();
});


Route::get('/logout', function(){
  Auth::logout();
  return redirect('/login');
});