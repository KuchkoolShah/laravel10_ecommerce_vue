<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Brand;
use App\Traits\ApiResponse;
use App\Traits\saveFile;
use Illuminate\Support\Facades\File;
class BrandController extends Controller
{
        
    use ApiResponse;
    use saveFile;
    public function index()
    {    
        
        $brand=Brand::get();     
        return view('admin.brand.brand' , compact('brand'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $validation = Validator::make($request->all(), [
            'text'    => 'required|string|max:255',
            'image'   => 'required|mimes:jpeg,png,jpg,gif|max:5120', // Max 5 MB
            'id' => 'required'
        ]);
        
       
           
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
           
    
                if($request->id > 0){
                    $image =Brand::find($request->id);
                    $imageName = $image->image;
                    $imageName = $this->saveImage($request->image ,$imageName ,"images/brands/" );
                }else{

                $imageName = $this->saveImage($request->image,'',"images/brands/" );
            }
            // Update or create the user
                $brand = Brand::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'text'         => $request->text,
                        'image'        => $imageName,
                    ]
                );
            
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success([],'Successfully updated');
           
        }
    }
}
