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
use App\Models\ProductAttrImages;
use App\Models\Tax;
use App\Models\Size;
use App\Models\Color;
use App\Models\CategoryAttribute;
use App\Traits\ApiResponse;
use App\Traits\saveFile;
use Redirect;
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
public function getAttributes(Request $request){
    $cat=$request->cat;

 $data =CategoryAttribute::where('category_id',$cat)->with(['attribute','values'])->get();
 return $this->success(['data'=>$data],'Successfully Update');
}

}