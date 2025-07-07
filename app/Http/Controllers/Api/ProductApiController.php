<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function list()
    {
        $product = Category::with('subcategories.products')->get();
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }
    public function create(Request $request)
    {
        $rules = array(
            'cat_name' => 'required|min:3|max:10|unique:categories',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } 
        else {
            $category = Category::create([
                'cat_name' => $request->cat_name
            ]);
            return $category . " added successfully";
        }
    }
    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->update([
            'cat_name' => $request->cat_name,
        ]);
        return $category . " updated successfully";
    }
    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);

        if ($category->delete()) {
            return "Category deleted";
        } else {
            return "operation failed";
        }
    }
    public function search($name)
    {
        $search = Category::where('cat_name', 'like', "%$name%")->get();
        if ($search->isNotEmpty()) {
            return $search;
        } else {
            return "Not found " . $name;
        }
    }
}
