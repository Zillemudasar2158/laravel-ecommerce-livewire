<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return 
        [
            new Middleware('permission:view category',only:['list']),
        ];
    }
    public function welcome()
    {
        return view('welcome');
    }
    public function catproduct($id)
    {
        $cat_ids = explode('&', $id);
        $category_id = $cat_ids[0];

        $category = Category::with('subcategories.products')->findOrFail($category_id);
        $categories = collect([$category]);

        if (count($cat_ids) > 1) 
        {
            $subcat_id = $cat_ids[1];

            $subcat = $category->subcategories->firstWhere('id', $subcat_id);

            if (!$subcat) 
            {
                abort(404, 'Subcategory not found.');
            }

            if (!$subcat->relationLoaded('products')) 
            {
                $subcat->load('products');
            }
            $subcategories = collect([$subcat]);
        } 
        else 
        {
            $subcategories = $category->subcategories;
        }

        return view('products.list', compact('categories', 'subcategories'));
    }
    public function list()
    {
        $paginatedCategories = Category::with('subcategories')->paginate(10, ['*'], 'cat_page');
        $paginatedSubcategories = Subcategory::with('category')->paginate(10, ['*'], 'subcat_page');

        return view('category.list', compact('paginatedCategories', 'paginatedSubcategories'));
    }
    public function create()
    {
    	$categories=Category::all();
    	return view('category.create',compact('categories'));
    }
    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'category'=>'required|min:3',
    	],
    	[
    		'category.min'=>'category name atleast 3 character',
    	]);

    	if ($validator->passes()) {
    		Category::create([
    			'cat_name'=>$request->category,
    		]);
    		return redirect()->route('category.list')->with('success','Category added successfully');
    	}
    	else{
    		return redirect()->route('category.create')->withInput()->withErrors($validator);
    	}
    }
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        return view('category.edit',compact('category'));
    }   
    public function update(Request $request,$id)
    {
        $category=Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category' => 'required|min:3|unique:categories,cat_name,' . $id . ',id',
        ]);

        if ($validator->passes()) {
           $category->update([
            'cat_name'=>$request->category
           ]);
           return redirect()->route('category.list')->with('success','Category updated sucessfully');
        }
        else
        {
            return redirect()->route('category.edit',$id)->withInput()->withErrors($validator);
        }
    }
    // ya function category delete k lia ha  
    public function destory($id)
    {
        $category=Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success','Category deleted Successfully');
    } 
    // ya function Sub-category delete k lia ha 
    public function destorysubcat($id)
    {
        $category=Subcategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success','Sub-Category deleted Successfully');
    }  
}
