<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use Image;
use App\Models\Multipic;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function allBrand()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request)
    {
        $validate_data = $request->validate([
            'brand_name' => 'required|unique:brands|min:4|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'. $img_ext;
        // $up_location = 'images/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location, $img_name);

        //intervetion image
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $last_img = 'images/brand/'.$name_gen;

        Image::make($brand_image)->resize(300, 200)->save($last_img);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        // return redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validate_data = $request->validate([
            'brand_name' => 'required|min:4|max:255',
            'brand_image' => 'mimes:jpg,jpeg,png'
        ]);
        
        $old_image = $request->old_image;
    
        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'. $img_ext;
            $up_location = 'images/brand/';
            $last_img = $up_location.$img_name;
            
            $brand_image->move($up_location, $img_name);
    
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
        }else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->back()->with('success', 'Brand updated successfully');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        unlink($brand->brand_image);
        $brand->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully');
    }

    public function multiPic()
    {
        $images = Multipic::latest()->get();
        return view('admin.multipic.index', compact('images'));
    }

    public function storeImage(Request $request)
    {
        $validate_data = $request->validate([
            "images"    => "required|array|min:1",
            'images.*' => 'required|mimes:jpg,jpeg,png'
        ]);
        
        $images = $request->file('images');

        foreach ($images as $image) {
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $last_img = 'images/multi/'.$name_gen;
    
            Image::make($image)->resize(300, 200)->save($last_img);
    
            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }

        return redirect()->back()->with('success', 'Mutliple image inserted successfully');
    }

}
