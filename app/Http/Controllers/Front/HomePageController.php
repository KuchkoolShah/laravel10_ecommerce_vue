<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\HomeBanner;
use App\Models\Brand;
use App\Models\Category;
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
       $data['categories'] = Category::with('products:id,category_id,name,slug,image,item_code')->where('parent_catetgory_id',null)->get();
      return $this->success(['data'=>$data], 'datta fetch Successfully');
    }
}
