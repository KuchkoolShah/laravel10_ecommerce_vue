<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\CategoryAttribute;
use App\Traits\ApiResponse;
use App\Traits\saveFile;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    
    
    use ApiResponse;
    use saveFile;
    public function index()
    {    
        $data=Attribute::get();  
        $category=Category::get();     
        return view('admin.category.category' , compact('category', 'data'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'slug'    => 'required|string|max:255',
           // 'attribute_id'    => 'required|exists:attributes,id',
            'image'   => 'required|mimes:jpeg,png,jpg,gif|max:5120', // Max 5 MB
            'id' => 'required'
        ]);
        
       
           
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
           
    
                if($request->id > 0){
                    $image =Category::find($request->id);
                    $imageName = $image->image;
                    $imageName = $this->saveImage($request->image ,$imageName ,"images/categories/" );
                }else{

                $imageName = $this->saveImage($request->image,'',"images/categories/" );
            }
            // Update or create the user

            
            if($request->parent_category_id != 0){
                $category = Category::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'name'         => $request->name,
                        'slug'        => $request->slug,
                        'image'        => $imageName,
                        'parent_catetgory_id'=> $request->parent_category_id
                    ]
                );
            }else{

                $category = Category::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'name'         => $request->name,
                        'slug'        => $request->slug,
                        'image'        => $imageName,
                    ]
                );
        }
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success([],'Successfully updated');
           
        }
    }

    public function  index_category_attribute()
    {     
        $data=CategoryAttribute::with('attribute' , 'category')->get();  
        $attribute=Attribute::get();  
        $category=Category::get();  
        //prx($data->toArray());  
        return view('admin.category.category_attribute' , compact('category' ,'attribute' ,'data'));
    }

    public function  store_category_attribute(Request $request)
    {     
        //dd($request->all());
        $validation = Validator::make($request->all(), [
            'attribute_id' => 'required',
            'category_id'=> 'required',
            
        ]);
        
       
           
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
                $category_attribute = CategoryAttribute::updateOrCreate(
                    
                    [
                        'attribute_id'         => $request->attribute_id,
                        'category_id'        => $request->category_id,
                    ]
                );
        
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success([],'Successfully updated');
           
        }
    }
}
