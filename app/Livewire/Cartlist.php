<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Str;

class Cartlist extends Component
{
    public $cart;
    public $shipping;
	public $payment;

    public function mount()
    {
        $this->cart = Cart::with('product')->where('user_id', auth()->id())->get();
    }

    public function increase($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem && $cartItem->quantity < 10) {
            $cartItem->quantity += 1;
            $cartItem->save();
        }

        $this->refreshCart();
    }

    public function decrease($cartId)
    {
        $cartItem = Cart::find($cartId);
        if ($cartItem) 
        {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->save();
            } 
            else 
            {
                $cartItem->delete(); 
            }
            $this->refreshCart();
        }
    }

    public function refreshCart()
    {
        $this->cart = Cart::with('product')->where('user_id', auth()->id())->get();
    }
    public function confirmOrder()
    {
        $this->validate([
            'shipping' => 'required|max:100',
            'payment' => 'required|in:cod,card',
        ]);

        $authuser = Auth::id();
        $orderno = 'ORD-' . strtoupper(Str::random(4)) . '-ER';

        $order = Order::create([
            'user_id' => $authuser,
            'order_number' => $orderno,
            'status' => 'pending',
            'total_amount' => 0,
            'payment_method' => $this->payment,
            'shipping_address' => $this->shipping,
        ]);

        $totalamount = 0;

        foreach ($this->cart as $cartitem) {
            OrderItem::create([
                'order_number' => $orderno,
                'user_id' => $authuser,
                'product_code' => $cartitem->product->product_code,
                'product_name' => $cartitem->product->name,
                'quantity' => $cartitem->quantity,
                'product_price' => $cartitem->product->price,
                'price_off' => $cartitem->product->price_off
            ]);

            $total = ($cartitem->product->price - ($cartitem->product->price * $cartitem->product->price_off) / 100) * $cartitem->quantity;
            $totalamount += $total;
        }

        $order->update([
            'total_amount' => $totalamount,
        ]);

        Cart::where('user_id', $authuser)->delete();

        $this->reset(['shipping', 'payment']);
        
        return redirect()->route('order.list')->with('success', 'Order confirmed successfully');
    }
    public function render()
    {
        return view('livewire.cartlist');
    }
}
