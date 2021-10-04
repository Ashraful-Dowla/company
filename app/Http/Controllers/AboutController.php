<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $about = About::latest()->paginate(5);
        return view('admin.about.index', compact('about'));
    }

    public function addAbout()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'title' => 'required|min:3|max:50',
            'short_description' => 'required|min:3|max:255',
            'long_description' => 'required|min:3|max:255',
        ]);

        About::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);

        return redirect(route('home.about'))->with('success', 'Inserted succefully');
    }

    public function edit($id)
    {
        $about = About::find($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $validate_data = $request->validate([
            'title' => 'required|min:3|max:50',
            'short_description' => 'required|min:3|max:255',
            'long_description' => 'required|min:3|max:255',
        ]);

        About::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);

        return redirect(route('home.about'))->with('success', 'Updated succefully');

    }

    public function destroy($id)
    {
        About::find($id)->delete();
        return redirect(route('home.about'))->with('success', 'Deleted succefully');
    }
}

