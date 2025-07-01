<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class CouponController extends Controller implements HasMiddleware
{
	public static function Middleware():array
	{
		return
		[
			new Middleware('permission:view category',only:['list','create','destory']),
		];
	}
    public function create()
    {
    	return view('coupon.create');
    }
    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'value'=>'required',
    		'day'=>'required',
    	]);

    	$couponcreate= 'C'.strtoupper(Str::random(4)).'N';
    	if ($validator->passes()) {
    		Coupon::create([
    			'code'=>$couponcreate,
    			'type'=>$request->coupontype,
    			'value'=>$request->value,
    			'expires_at'=>$request->day,
    		]);
    		return redirect()->route('coupon.list')->with('success','Coupon Added Successfully');
    	}
    	else{
    		return redirect()->route('coupon.create')->withInput()->withErrors($validator);
    	}
    }
    public function list()
    {
    	$coupon=Coupon::paginate(20);
    	return view('coupon.list',compact('coupon'));
    }
    public function edit($id)
    {
    	return view('coupon.edit');
    }
    public function destory()
    {
    	
    }
}
