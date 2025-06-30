<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
	public $productId;
    public $quantity = 1;

    public function increment()
    {
        if ($this->quantity < 10) $this->quantity++;
    }
    public function decrement()
    {
    	if ($this->quantity>1)$this->quantity--;
    }
    public function addToCart()
    {
    	if (!Auth::check()) {
    		return redirect()->route('/login');
    	}
    	$userId=Auth::id();
    	$existing=Cart::where('user_id',$userId)->where('product_id',$this->productId)->first();

    	if ($existing) {
    		$existing->quantity +=$this->quantity;
    		$existing->save();
    	}
    	else{
    		Cart::create([
    			'user_id' => $userId,
                'product_id' => $this->productId,
                'quantity' => $this->quantity,
    		]);
    	}
    	session()->flash('success', 'Product added to cart!');
        $this->quantity = 1;
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
