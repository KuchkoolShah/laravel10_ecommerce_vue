<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Traits\ApiResponse;
class AttributeController extends Controller
{


    use ApiResponse;

    public function index_attribute_name()
    {
        $attribute=Attribute::get();     
        return view('admin.attribute.attribute' , compact('attribute'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store_attribute_name(Request $request)
    {
       // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'slug'    => 'required|string|max:255',
            'id' => 'required'
        ]);
        
       
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
           
            // Update or create the user
            $attribute= Attribute::updateOrCreate(
                ['id' => $request->id],
                [
                    'name'=> $request->name,
                    'slug'=> $request->slug,
                    
                ]
            );
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success(['reload'=>true],'Successfully updated');
           
        }
    }

    public function index_attribute_value()
    {
        $attribute=Attribute::get(); 
        $data=AttributeValue::with('singleAttribute')->get();     
        return view('admin.attribute.attribute_value' , compact('attribute' ,'data'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store_attribute_value(Request $request)
    {
       // dd($request->all());
        $validation = Validator::make($request->all(), [
            'attribute_id'    => 'required|exists:attributes,id',
            'attribute_value'    => 'required|string|max:255',
            'id' => 'required'
        ]);
        
       
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
           
            // Update or create the user
            $attributeValue= AttributeValue::updateOrCreate(
                ['id' => $request->id],
                [
                    'attribute_id' => $request->attribute_id,
                    'value' => $request->attribute_value,
                    
                ]
            );
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success(['reload'=>true],'Successfully updated');
           
        }
    }
}
