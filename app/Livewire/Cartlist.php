<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Str;

class Cartlist extends Component
{
    public $cart;
    public $shipping;
    public $payment;
    public $couponCode, $discount = 0;

    public function mount()
    {
        $this->refreshCart();

        if (session()->has('coupon')) {
            $this->discount = session('coupon.discount');
            $this->couponCode = session('coupon.code');
        }
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
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
            $this->refreshCart();
        }
    }

    public function refreshCart()
    {
        $this->cart = Cart::with('product')->where('user_id', auth()->id())->latest()->get();
    }

    public function applyCoupon()
    {
        $coupon = Coupon::where('code', $this->couponCode)->first();

        if (!$coupon) {
            session()->flash('error', 'Invalid coupon code.');
            return;
        }

        if ($coupon->isExpired()) {
            session()->flash('error', 'Coupon expired.');
            return;
        }

        $total = 0;
        foreach ($this->cart as $item) {
            $price = $item->product->price;
            $discounted = ($price - ($price * $item->product->price_off / 100)) * $item->quantity;
            $total += $discounted;
        }

        $this->discount = $coupon->discountAmount($total);

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $this->discount,
            'id' => $coupon->id,
        ]);

        // update property too
        $this->couponCode = $coupon->code;

        session()->flash('success', 'Coupon applied successfully.');
    }
    public function removeCoupon()
    {
        session()->forget('coupon');
        $this->reset(['couponCode', 'discount']); 
        $this->refreshCart(); 
        session()->flash('success', 'Coupon removed successfully.');
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
            'payment_method' => $this->payment,
            'shipping_address' => $this->shipping,
            'coupon_code' => $this->couponCode ?? null,  
            'discount' => $this->discount ?? 0,         
            'total_amount' => 0,
        ]);

        $totalamount = 0;

        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_number' => $orderno,
                'user_id' => $authuser,
                'product_code' => $item->product->product_code,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'product_price' => $item->product->price,
                'price_off' => $item->product->price_off,
            ]);

            $total = ($item->product->price - ($item->product->price * $item->product->price_off / 100)) * $item->quantity;
            $totalamount += $total;
        }

        // ✅ FINAL AMOUNT using Livewire property (not session)
        $finalAmount = $totalamount - $this->discount;

        $order->update([
            'total_amount' => $finalAmount,
        ]);

        // ✅ Coupon delete from DB if applied
        if (session()->has('coupon.id')) {
            Coupon::find(session('coupon.id'))?->delete();
        }

        Cart::where('user_id', $authuser)->delete();
        session()->forget('coupon');
        $this->reset(['shipping', 'payment', 'couponCode', 'discount']);

        return redirect()->route('order.list')->with('success', 'Order confirmed successfully');
    }

    public function render()
    {
        return view('livewire.cartlist');
    }
}
