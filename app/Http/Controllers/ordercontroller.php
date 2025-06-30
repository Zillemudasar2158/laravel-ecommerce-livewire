<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ordercontroller extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return 
        [
            new Middleware('permission:view all orders',only:['alllistorder']),
        ];
    }
    public function list()
    {
        $user_id=auth()->user()->id;
        $orders=Order::where('user_id',$user_id)->get();
        return view('orders.list',compact('orders'));
    }
    public function orderfind($data)
    {
        $cart=Order::with('OrderItem')->where('order_number',$data)->first();
        return view('orders.orderfind',compact('cart'));
    }
    public function edit($id)
    {
        $order=Order::findOrFail($id);
        return view('orders.edit',compact('order'));
    }
    public function update(Request $request,$id)
    {
        $order=Order::findOrFail($id);
        
        $order->update([
           'status'=>$request->paymentstatus, 
        ]);
        return redirect()->route('allorder.list')->with('success','Order status updated successfully');
    }
    public function alllistorder()
    {
        $orders=Order::with('OrderItem')->get();
        return view('orders.list',compact('orders'));
    }
}
