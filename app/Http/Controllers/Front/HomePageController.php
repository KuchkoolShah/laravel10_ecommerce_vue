<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\HomeBanner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductAttr;
use App\Models\CategoryAttribute;
use App\Models\TempUsers;
use Validator;
use App\Models\Cart;
class HomePageController extends Controller
{
    use ApiResponse;

    public function getCategories(){
        $data=[];
        $data['categories'] = Category::with('subcategories')->where('parent_catetgory_id',null)->get();
       return $this->success(['data'=>$data], 'datta fetch Successfully');
     }

    public function getHomeData(){
       $data=[];
       $data['banner'] = HomeBanner::get();
       $data['brands'] = Brand::get();
       $data['products'] = Product::with('productAttributes')->select('id','category_id','name','slug','image','item_code')->get();
       $data['categories'] = Category::with('products:id,category_id,name,slug,image,item_code')->where('parent_catetgory_id',null)->get();
      return $this->success(['data'=>$data], 'datta fetch Successfully');
    }

    public function getCategoryData($slug=""){
        $category = Category::where('slug',$slug)->first();
        //dd( $data);
       if(isset($category->id)){
        $products= Product::where('category_id',$category->id)->with('productAttributes')->select('id','name','slug','image','item_code')->paginate(10);
        if($category->parent_catetgory_id ==null || $category->parent_catetgory_id==''){
            $categories=Category::where('parent_catetgory_id',$category->d)->get();
           }else{
            $categories=Category::where('parent_catetgory_id',$category->parent_catetgory_id)->where('id'!=$category->id)->get();
           }
    }else{
        $category = Category::first();
        $products= Product::where('category_id',$category->id)->with('productAttributes')->select('id','category_id','name','slug','image','item_code')->paginate(10);
        if($category->parent_catetgory_id ==null || $category->parent_catetgory_id==''){
            $categories=Category::where('parent_catetgory_id',$category->d)->get();
           }else{
            $categories=Category::where('parent_catetgory_id',$category->parent_catetgory_id)->where('id'!=$category->id)->get();
           }
       }


        $lowPrice= ProductAttr::orderBy('price', 'asc')->pluck('price')->first();
        $highPrice= ProductAttr::orderBy('price', 'desc')->pluck('price')->first();
        $attributes= CategoryAttribute::where('category_id',$category->id)->with('attribute')->get();
        $brands = Brand::get();
        $color= Color::get();
        $size = Size::get();
        return $this->success(['data'=>get_defined_vars()], 'datta fetch Successfully');
    }
    public function getFilterData($category_id, $size=[], $color=[], $brand=[], $attribute=[],$highPrice,$lowPrice ){
        $products= Product::where('category_id',$category_id)->get();
        //dd( $data);

       if(sizeof($brand > 0)){
        $products= Product::whereIn('brand_id',$brand)->whereIn('id', $products->pluck('id'))->get();
    }
    if(sizeof($attribute > 0)){
        $products= ProductAttribute::whereIn('attribute_value_id ',$attribute)->whereIn('id', $products->pluck('id'))->get();
        $products= Product::whereIn('id', $products->pluck('product_id'))->get();
    }
    $data= ProductAttr::orderBy('price', 'asc')->whereIn('id', $data->pluck('id'))->get();
    if(sizeof($size > 0)){
        $data= ProductAttr::whereIn('size_id', $size)->whereIn('id', $data->pluck('id'))->get();
    }
    if(sizeof($color > 0)){
        $data= ProductAttr::whereIn('color_id', $color)->whereIn('id', $data->pluck('id'))->get();
    }
    if($lowPrice !='' &&  $lowPrice != null && $highPrice != ''){
        $data= ProductAttr::whereBetween('price', [$lowPrice,$highPrice])->whereIn('id', $data->pluck('id'))->get();
    }

        return $this->success(['data'=>get_defined_vars()], 'datta fetch Successfully');
    }

    public function getUserData(Request $request){
        //dd($request->all());
        $token = $request->tokem;
        $checkUser =TempUsers::where('token'.$token)->first();
        if(isset($checkUser->id)){
          $data['user_type'] =$checkUser->user_type;
          $data['token'] =$checkUser->token;
          if(checkedTokenExoiryInMinutes($checkUser->update_at,60)){
              $token = generateRandomString();
              $checkUser->token =$token;
              $checkUser->update_at =date('Y-m-d h:i:s a', time());
              $checkUser->save();
              $data['token'] = $token;
          }
        }else{
        }
    }

    public function getCartData(Request $request){
         $valadition = Validator::make($request->all() , [
                'token' => 'required|exists:temp_users|max:255',
            ]);
            if($valadition->fails()){
                return $this->error($valadition->errors()->first() , 400 ,[]);
            }else{
                $userToken = TempUsers::where('token',$request->token)->first();
                $data =Cart::where('user_id' , $userToken->user_id)->with('products')->get();
                return $this->success(['data'=>get_defined_vars()], 'Successfully data fetched');
            }
        }
        public function addToCart(Request $request){
            $valadition = Validator::make($request->all() , [
                   'token' => 'required|exists:temp_users|max:255',
                   'product_id' => 'required|exists:products|max:255',
                   'product_attrr_id' => 'required|exists:ProductAttribute|max:255',
                   'qty' => 'required|numeric|min:0|not_in:0',
               ]);
               if($valadition->fails()){
                   return $this->error($valadition->errors()->first() , 400 ,[]);
               }else{
                   $userToken = TempUsers::where('token',$request->token)->first();
                   Cart::updateorCreate([
                    ['product_id' =>$request->product_id, 'user_id' =>$$userToken->user_id,
                    'product_attrr_id'=>$request->product_attrr_id],
                    'product_id' =>$request->product_id,
                    'product_attrr_id'=>$request->product_attrr_id,
                    'qty' =>$request->qty,
                    'user_id' =>$userToken->user_id,
                    'user_type' =>$userToken->user_type,
                   ]);
                   return $this->success(['data'=>get_defined_vars()], 'Successfully data fetched');
               }
           }
}
