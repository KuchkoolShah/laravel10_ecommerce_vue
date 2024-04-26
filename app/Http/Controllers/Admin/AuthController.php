<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Role;
use Hash; 
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function createCustomer()
    {
      $user         =  new User();
      $user->name   =  'Admin';
      $user->email   =  'Admin@gmail.com';
      $user->password = Hash::make('1234');
      $user->save();
 
      $customer = Role::where('slug','admin')->first();
 
      $user->roles()->attach($customer);
    }

    public function ShowLoginForm(){
      
    }
}
