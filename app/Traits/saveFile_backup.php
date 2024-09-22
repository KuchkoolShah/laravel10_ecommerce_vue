<?php
 
namespace App\Traits;
use Illuminate\Support\Facades\File;
trait saveFile
{
    protected function saveImage($file , $previousImage ='' , $path='' ,  $id='')
    {
        if( $previousImage != ''){
           
        $image_path = $previousImage;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        }
       
        if($path != ''){
            $image_name = time() . '.' . $file->extension();
            $file->move(public_path('images/'), $image_name);
        }else{
            $image_name =''. $path .'/'.time() . '.' . $file->extension();
            $file->move(public_path($path), $image_name);
        }
        echo "<pre/>";print_r($file);
        echo "<pre/>";print_r('image' , $image_name);
        //echo "<pre/>";print_r($path);
        //echo "<pre/>";print_r($previousImage);
    return  $image_name;
   
    }
}