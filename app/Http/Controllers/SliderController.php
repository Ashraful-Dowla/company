<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validate_data = $request->validate([
            'title' => 'required|min:4|max:255',
            'description' => 'required|min:4|max:255',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
            
        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        $last_img = 'images/slider/'.$name_gen;

        Image::make($slider_image)->resize(1920, 1008)->save($last_img);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return redirect(route('home.slider'))->with('success', 'Slider inserted successfully');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $validate_data = $request->validate([
            'title' => 'required|min:4|max:255',
            'description' => 'required|min:4|max:255',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $slider_image = $request->file('image');
        $old_image = $request->old_image;

        if($slider_image){
            $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            $last_img = 'images/slider/'.$name_gen;
    
            Image::make($slider_image)->resize(1920, 1008)->save($last_img);

            unlink($old_image);
    
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
            ]);
        }else {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        }

        return redirect(route('home.slider'))->with('success', 'Slider updated successfully');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        unlink($slider->image);
        $slider->delete();
        return redirect()->back()->with('success', 'Slider deleted successfully');
    }
}
