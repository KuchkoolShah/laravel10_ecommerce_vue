<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttr;
use App\Models\ProductAttribute;
use App\Models\ProductAttrImages;
use App\Models\Tax;
use App\Models\Size;
use App\Models\Color;
use App\Models\CategoryAttribute;
use App\Traits\ApiResponse;
use App\Traits\saveFile;
use Redirect;
use DB;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    use ApiResponse;
    use saveFile;
    public function index()
    {    
          $product =Product::all();
        return view('admin.product.product', compact('product'));
    }

    public function viewProduct($id=0)
    {    
       
        if($id == 0){
            $product =Product::all();
            $attribute =Attribute::all();
            $brand =Brand::all();
            $category =Category::all();
            $productAttr=ProductAttr::all();
            $product_attrImage =ProductAttrImages::all();
            $tax =Tax::all();
            $size =Size::all();
            $color =Color::all();
        }else{
            $data['id']=$id;
            $validation = Validator::make($data, [
               'id' => 'required|exists:products,id'
           ]);
           if ($validation->fails()) {
            return redirect()->back();
           } else {
            $data =Product::where('id',$id)->first();
           }
        }  
        return view('admin.product.manage_product', get_defined_vars());
       
    }

    public function store(Request $request)
    {
       // print_r($request->all());
        
                //   echo "<pre>";
                //     print_r($request->all());
                //     exit;
       try{
                DB::beginTransaction();
                $validation = Validator::make($request->all(), [
                    'category_id'    => 'required|string|max:255',
                    //'image'   => 'required|mimes:jpeg,png,jpg,gif|max:5120', // Max 5 MB
                    'name' => 'required|string|max:255',
                    'slug' => 'required|string|max:255',
                    //'id' => 'required'
                ]);


                if ($validation->fails()) {
                    return $this->error($validation->errors()->first(), 400,[]);
                    //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
                } else {
                    //dd($request->image);
                    if ($request->hasFile('image')) {
                        if($request->id>0){
                            $image =Product::where('id', $request->id)->first();
                            $image_path = "images/".$image->image."";
                            if(File::exists($image_path)){
                                File::delete($image_path);
                            }
                        }

                        $image_name ='images/products/'.$request->name.time() . '.' . $request->image->extension();
                        $request->image->move(public_path('images/products/'), $image_name);
                    }
                // elseif($request->id>0){
                //     $image_name =Product::where('id', $request->id)->pluck('image')->first();
                // }
                // Update or create the user
                $productId= Product::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'name'         => $request->name,
                        'slug'        => $request->slug,
                        'category_id'        => $request->category_id,
                        'keywords'        => $request->keyword,
                        'tax_id'        => $request->tax_id,
                        'brand_id'        => $request->brand_id,
                        'description'        => $request->mytextarea,
                        'item_code'        => $request->item_code,
                        'image'        => isset($image_name) ? $image_name : null,
                    
                    ]
                );
                $productId=$productId->id;
                //dd($request->attribute_id);
                ProductAttribute::where('product_id',$productId)->delete();
                foreach($request->attribute_id as $key=>$val ){
                  
                    $product_attr_id=ProductAttribute::updateOrCreate(
                    ['product_id' => $productId , 'category_id'=>$request->category_id,
                    'attribute_value_id'=>$val],
                    ['product_id' => $productId , 'category_id'=>$request->category_id,
                    'attribute_value_id'=>$val],
                );
                //dd($product_attr_id);
            }
              $attrImage =[];
                // foreach($request->imageValue as $key=>$val ){
                //     array_push($attrImage , $val);
                // }
                foreach($request->sku as $key=>$val ){
                 
                    $productAttr=ProductAttr::updateOrCreate(
                        ['id' => '0'],
                        [
                            'product_id'=>$productId,
                            'color_id'=>$request->color_id[$key],
                            'size_id'=>$request->size_id[$key],
                            'sku'=>$request->sku[$key],
                            'price'=>$request->price[$key],
                            'mrp'=>$request->mrp[$key],
                            'breadth'=>$request->breath[$key],
                            'height'=>$request->height[$key],
                            'weigth'=>$request->weigth[$key]
                        ],
                    );
                  
                    $product_attr_id =$productAttr->id;
                    // echo "<pre>";
                    // print_r($request->all());
                    // exit;
                    //dd($product_attr_id);
                    //ProductAttrImages::where( ['product_id' => $productId ,"product_attr_id"=>$product_attr_id])->delete();
                    foreach($request->imageValue as $key=>$val){
                        //dd($val);
                        $imageVal='attr_image_'.$val;
                        foreach($request->$imageVal as $key=>$val1){
                        //dd($val);
                        $image_name = "images/productsAttr/".$request->name.time().'.'.$val1->extension();
                         //dd($image_name);
                         //dd($productId, $product_attr_id, $image_name);
                                $val1->move(public_path('images/productsAttr/'), $image_name);
                                $productAttrImg=ProductAttrImages::Create(
                                    ['product_id' => $productId ,"product_attr_id"=>$product_attr_id, 'image'=> $image_name,],
                                  
                                );
                                //dd($productAttrImg);
                            }
                            }
                    DB::commit();
                    //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                        return $this->success(['reload'=>true],'Successfully updated');
                }
                }
              
              
            }catch(e){
             DB::rollBack();
                }
                
    }
public function getAttributes(Request $request){
    $cat=$request->cat;
    $data =CategoryAttribute::where('category_id',$cat)->with(['attribute','values'])->get();
    return $this->success(['data'=>$data],'Successfully Update');
}

}