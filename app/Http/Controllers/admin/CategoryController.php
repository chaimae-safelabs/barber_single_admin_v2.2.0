<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Helpers\Helper;
use App\Http\Helpers;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('cat_id', 'DESC')->paginate(8);
        return view('admin.pages.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg|required',
            'name' => 'bail|required|unique:category'
        ]);

        $category = new Category();
        if ($request->hasFile('image')) {
            $category->image = (new Helper)->imageUpload($request->image, 'categories');
        }
        $category->name = $request->name;
        $category->save();
        return response()->json(['success' => true, 'data' => $category, 'msg' => 'category create'], 200);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['success' => true, 'data' => $category], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required|unique:category,name,' . $id . ',cat_id',
            'image' => 'bail|mimes:jpeg,png,jpg',

        ]);

        $category = Category::find($id);
        if ($request->hasFile('image')) {
            if ($category->image != "noimage.jpg") {
                if (\File::exists(public_path('/storage/images/categories/' . $category->image))) {
                    \File::delete(public_path('/storage/images/categories/' . $category->image));
                }
            }
            $category->image = (new Helper)->imageUpload($request->image, 'categories');            
        }
        $category->name = $request->name;
        $category->save();
        return response()->json(['success' => true, 'data' => $category, 'msg' => 'category edit'], 200);
    }

    public function hideCategory(Request $request)
    {
        $category = Category::find($request->categoryId);
        if ($category->status == 0) {
            $category->status = 1;
            $category->save();
        } else if ($category->status == 1) {
            $category->status = 0;
            $category->save();
        }
    }
}
