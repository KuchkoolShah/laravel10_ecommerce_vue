<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Tax;
use App\Traits\ApiResponse;
class TaxController extends Controller
{
    
    use ApiResponse;

    public function index()
    {
        $tax=Tax::get();     
        return view('admin.tax.tax' , compact('tax'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
        $validation = Validator::make($request->all(), [
            'tax'    => 'required|max:255',
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
           
            // Update or create the user
            $tax= Tax::updateOrCreate(
                ['id' => $request->id],
                [
                    'text'=> $request->tax,
                ]
            );
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success(['reload'=>true],'Successfully updated');
           
        }
    }
}
