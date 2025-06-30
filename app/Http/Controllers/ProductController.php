<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\subcategory;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class ProductController extends Controller implements HasMiddleware
{
	public static function Middleware():array
	{
		return
		[
            new Middleware('permission:create products',only:['create']),
            new Middleware('permission:edit products',only:['edit']),
            new Middleware('permission:delete products',only:['delete']),
		];
	}

    public function list()
    {
		$categories =Category::with('subcategories.products')->get();
        return view('products.list', compact('categories'));
    }

    public function create()
    {
        $categories=Category::with('subcategories')->get();
        return view('products.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|min:10|max:50',
            'price'        => 'required|integer',
            'dis_price'    => 'nullable|integer',
            'category'     => 'required',
            'image'        => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.create')
                             ->withInput()
                             ->withErrors($validator);
        }

        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product'), $imageName);
            }
        }

        $randomCode = strtoupper(Str::random(4));
        $productCode = 'PRO-' . $randomCode . '-C' . $request->category;

        Product::create([
            'name'         => $request->name,
            'product_code' => $productCode,
            'price'        => $request->price,
            'price_off'    => $request->dis_price,
            'category_id'  => $request->category,
            'img_path'     => $imageName,
        ]);

        return redirect()->route('product.list')->with('success', 'Product added successfully');
    }
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        $categories=Category::all();
        return view('products.edit',compact('product','categories'));
    }
    public function update(Request $request,$id)
    {
        $product=Product::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'name'         => 'required|min:10|max:50',
            'price'        => 'required|integer',
            'dis_price'    => 'nullable|integer',
            'category'     => 'required',
        ]);
        if ($validator->passes()) {
            $product->update([
                'name'         => $request->name,
                'price'        => $request->price,
                'price_off'    => $request->dis_price,
                'category_id'  => $request->category,
            ]);
            return redirect()->route('product.edit',$id)->with('success','Product updated successfully');
        }
        else
        {
            return redirect()->route('product.edit',$id)->withInput()->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success','Product deleted Successfully');
    }

    //For search bar
    public function globalSearch(Request $request)
    {
        $q = $request->q;

        $products = Product::where('name', 'like', "%{$q}%")
            ->orWhere('price', 'like', "%{$q}%")
            ->orWhere('product_code', 'like', "%{$q}%") 
            ->select('id', 'name', 'product_code') 
            ->limit(5)
            ->get();

        $categories = Category::where('cat_name', 'like', "%{$q}%")
            ->select('id', 'cat_name')
            ->limit(5)
            ->get();

        $subcategories = Subcategory::with('category') 
            ->where('subcat_name', 'like', "%{$q}%")
            ->select('id', 'subcat_name', 'categories_id')
            ->limit(5)
            ->get();


        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
    public function productsearch(Request $request,$id)
    {
        $product= Product::with('subcategory')->findOrFail($id);
        return view('products.searchproduct',compact('product'));
    }
}
