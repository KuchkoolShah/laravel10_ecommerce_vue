<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
class SizeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $size=Size::get();     
        return view('admin.size.size' , compact('size'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $validation = Validator::make($request->all(), [
            'text'    => 'required|string|max:255',
            'id' => 'required'
        ]);
        
       
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
           
            // Update or create the user
            $size= Size::updateOrCreate(
                ['id' => $request->id],
                [
                    'text'         => $request->text,
                    
                ]
            );
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success(['reload'=>true],'Successfully updated');
           
        }
    }

}
