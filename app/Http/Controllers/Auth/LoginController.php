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
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }else{
            $cred = array('email'=>$request->email , 'password'=>$request->password);
            if(Auth::attempt($cred , false)){
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

}
