<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function list()
    {
    	$user_id=auth()->user()->id;    	
    	$cart=Cart::with('product')->where('user_id',$user_id)->get();
    	return view('Cart.list',compact('cart'));
    }
    public function store(Request $request)
    {
        $user_id=auth()->user()->id;
        $pro=Cart::with('product')
            ->where(['user_id'=> $user_id , 'product_id'=>$request->id])
            ->first();

        if ($pro) {
            $pro->update([
                'quantity'=>$request->quantity + $pro->quantity,
            ]);
            return redirect()->route('product.list')->with('success','Product added successfully');
        }
        else{
            Cart::create([
         'product_id'=>$request->id,
         'user_id'=>$user_id,
         'quantity'=>$request->quantity,
        ]);
        return redirect()->route('product.list')->with('success','Product added successfully');
        }    	
    }
    public function update(Request $request,$id)
    {
        $pro=Cart::findOrFail($id);

        if ($request->action =='increase') {
            $pro->quantity +=1;
        }
        elseif($request->action=='decrease'){
            $pro->quantity -=1;
            if ($pro->quantity<1) {
                $pro->delete();
                return back()->with('success', 'Item removed from cart');
            }
        }

        $pro->save();

        return back()->with('success', 'Cart updated');
    }
}
