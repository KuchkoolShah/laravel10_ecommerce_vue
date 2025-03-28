<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{
    //

    public function  loginUser(Request $request){
        //dd("404");
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }else{
            $cred = array('email'=>$request->email , 'password'=>$request->password);
            //dd($cred);
            if(Auth::attempt($cred , false)){
                //dd("404");
                if(Auth::User()->hasRole('admin')){
                return response()->json(['status'=>200 , 'meaasage'=>"Admin  User" , "url"=>"admin/dashboard"]);
                }else{
                    return response()->json(['status'=>200 , 'meaasage'=>"Not   User"]);
                }
            }else{
                return response()->json(['status'=>404 , 'meaasage'=>"Wrong User"]);
            }
        }

    }

    public function register(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Return success response with user data (excluding password)
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return response()->json([
            'message' => 'User logged out successfully',
        ], 200);
    }

}
