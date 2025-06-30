<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Validator;

class SubcatController extends Controller
{
    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'subcat'=>'required|min:3',
    		'category_id'=>'required'
    	]);
    	if ($validator->passes()) {
    		Subcategory::create([
    			'subcat_name'=>$request->subcat,
    			'categories_id'=>$request->category_id
    		]);
    		return redirect()->route('category.list')->with('success','Subcategory added successfully');
    	}
    	else{
    		return redirect()->route('category.create')->withInput()->withErrors($validator);
    	}
    }
}
