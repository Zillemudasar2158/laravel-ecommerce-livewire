<div class="overflow-x-auto bg-white rounded shadow-sm">
    @if($cart->isNotEmpty())
    <p class="text-center text-lg md:text-xl font-medium mt-4">
        <u>Once confirmed, your order will be queued and processed shortly.</u>
    </p><br>    
    <table class="min-w-full text-sm text-left border border-gray-300">
        <thead class="bg-gray-50">
            <tr class="border-b">
                <th class="px-4 py-3">Sr No.</th>
                <th class="px-4 py-3">Product</th>
                <th class="px-4 py-3">Image</th>
                <th class="px-4 py-3 text-center">Quantity</th>
                <th class="px-4 py-3">Unit Price</th>
                <th class="px-4 py-3">Discount</th>
                <th class="px-4 py-3">Total</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @php $grandTotal = 0; @endphp
            @foreach($cart as $index => $item)
                @php
                    $price = $item->product->price;
                    $discountitem = $item->product->price_off;
                    $total = ($price - ($price * $discountitem / 100)) * $item->quantity;
                    $grandTotal += $total;
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $item->product->name }}</td>
                    <td class="px-4 py-3">
                        <img src="{{ asset('product/' . $item->product->img_path) }}" class="w-12 h-12 object-cover rounded">
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center space-x-2">
                            <button wire:click="decrease({{ $item->id }})"
                                    class="px-2 py-1 bg-gray-300 rounded">−</button>

                            <input type="text" readonly value="{{ $item->quantity }}"
                                   class="w-10 text-center border rounded px-2 py-1" />

                            <button wire:click="increase({{ $item->id }})"
                                    class="px-2 py-1 bg-gray-300 rounded">+</button>

                        </div>
                    </td>
                    <td class="px-4 py-3">Rs. {{ $item->product->price }}</td>
                    <td class="px-4 py-3">{{ $item->product->price_off }}%</td>
                    <td class="px-4 py-3 font-semibold">Rs. {{ number_format($total) }}</td>
                </tr>
            @endforeach   
            <tr>
                <td colspan="8" class="px-4 py-3 text-right font-semibold text-lg"> 
                    @if (session()->has('coupon'))
                        Coupon Applied: <strong>{{ session('coupon.code') }}</strong> 
                        (Rs. {{ number_format(session('coupon.discount')) }} Off)
                        <button wire:click="$set('couponCode', '')" 
                                wire:click.prevent="removeCoupon"
                                class="bg-red-600 text-white px-3 py-1 ml-2 rounded">
                            Cancel Coupon
                        </button>
                    @else
                        Apply Coupon:
                        <input type="text" wire:model.defer="couponCode" placeholder="Enter code..." class="border rounded px-3 py-1 ml-2">
                        <button wire:click="applyCoupon" class="bg-slate-700 text-white px-3 py-1 ml-2 rounded">Apply</button>
                    @endif
                </td>
                    @if (session()->has('success'))
                        <span class="text-green-600 ml-3">{{ session('success') }}</span>
                    @elseif (session()->has('error'))
                        <span class="text-red-600 ml-3">{{ session('error') }}</span>
                    @endif
            </tr>
            <tr>
                @php
                    $subtotal = $cart->sum(fn($item) =>
                        ($item->product->price - ($item->product->price * $item->product->price_off / 100)) * $item->quantity
                    );

                    $couponDiscount = $discount ?? session('coupon.discount') ?? 0;

                    $grandTotal = $subtotal - $couponDiscount;
                @endphp

                <td colspan="6" class="px-4 py-3 text-right font-semibold text-lg">Grand Total:</td>
                <td class="px-4 py-3 text-right font-bold text-lg text-green-700">Rs. {{ number_format($grandTotal) }}</td>
            </tr>
        </tbody>
    </table>



@if($grandTotal > 0)
<div class="mt-10 flex justify-center">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
        <form wire:submit.prevent="confirmOrder" class="space-y-6">
            <div>
                <label for="shipping" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address:</label>
                <input type="text" wire:model.lazy="shipping" id="shipping"
                    placeholder="Enter your shipping address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('shipping')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <p class="text-sm font-medium text-gray-700 mb-2">Payment Mode:</p>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model="payment" value="cod"
                            class="text-green-600 focus:ring-green-500">
                        <span>Cash on Delivery</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model="payment" value="card"
                            class="text-green-600 focus:ring-green-500">
                        <span>Credit/Debit Card</span>
                    </label>
                </div>
                @error('payment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md text-base font-semibold transition duration-200 ease-in-out">
                    Confirm Order
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@else
    <p class="text-center text-lg text-gray-600">Your cart is empty.</p>
@endif

</div>