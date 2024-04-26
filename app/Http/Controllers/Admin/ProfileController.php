<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
class ProfileController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        return view('admin/profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|unique:users,email,'.Auth::user()->id,
            'image'   => 'required|mimes:jpeg,png,jpg,gif|max:5120', // Max 5 MB
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'twitter_link' => 'required|string|max:255',
             'fb_link' => 'required|string|max:255',
             'inst_link' => 'required|string|max:255',
            // 'user_id' => 'required|exists:users,id'
        ]);
        
       
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
            if ($request->hasFile('image')) {
                $image_name ='images/'.$request->name . '_' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/'), $image_name);
            }else{
                $image_name=Auth::user()->image;
            }
            // Update or create the user
            $user = User::updateOrCreate(
                ['id' => Auth::user()->id],
                [
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'image'        => isset($image_name) ? $image_name : null,
                    'address'      => $request->address,
                    'phone'        => $request->phone,
                    'twitter_link' => $request->twitter_link,
                    'fb_link'      => $request->fb_link,
                    'inst_link'    => $request->inst_link
                ]
            );
            
           
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success([],'Successfully updated');
           
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
