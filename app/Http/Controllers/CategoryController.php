<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function allCat()
    {
        $categories = Category::latest()->paginate(2);
        $trashedCategories = Category::onlyTrashed()->latest()->paginate(2);
        return view('admin.category.index', compact('categories', 'trashedCategories'));
    }

    public function addCat(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Succesfully Inserted');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        $category = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/category/all')->with('success', 'Updated Succefully');
    }

    public function softDelete($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted Succeffully');
    }

    public function restore($id)
    {
        $restore = Category::withTrashed($id)->restore();
        return redirect()->back()->with('success', 'Restored Succeffully');
    }

    public function forceDelete($id)
    {
        $forceDelete = Category::onlyTrashed($id)->forceDelete();
        return redirect()->back()->with('success', 'Permanent Succeffully');
    }    
}
