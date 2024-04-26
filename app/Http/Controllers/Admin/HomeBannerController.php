<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;
use Validator;
use App\Traits\ApiResponse;
use DB;
class HomeBannerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home_banner=HomeBanner::get();     
        return view('admin.home_banner' , compact('home_banner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'link' => 'required|string|max:255',
            'id' => 'required'
        ]);
        
       
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400,[]);
            //return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
            if ($request->hasFile('image')) {
                if($request->id>0){
                    $image =HomeBanner::where('id', $request->id)->first();
                    $image_path = "images/".$image->image."";
                    if(File::exists($image_path)){
                        File::delete($image_path);
                    }
                }

                $image_name ='images/'.$request->name . '_' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/'), $image_name);
            }elseif($request->id>0){
                $image_name =HomeBanner::where('id', $request->id)->plucck('image')->first();
            }
            // Update or create the user
            $home_banner= HomeBanner::updateOrCreate(
                ['id' => $request->id],
                [
                    'text'         => $request->text,
                    'link'        => $request->link,
                    'image'        => isset($image_name) ? $image_name : null,
                   
                ]
            );
            
           
               //return response()->json(['status' => 200, 'message' => "Successfully updated"]);
                return $this->success(['reload'=>true],'Successfully updated');
           
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteData($id = " " , $table=""){
        DB::table(''.$table.'')->where('id', $id)->delete();
        return $this->success(['reload'=>true], 'Successfully  delete');
    }
}
