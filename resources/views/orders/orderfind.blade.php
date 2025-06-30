<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-message />

            <!-- ✅ Order Track Heading -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Tracking Order Number</h2>
                <p class="text-sm text-gray-600 mt-1">Order Number: <span class="font-medium text-blue-700"><u>{{ $cart->order_number }}</u></span></p>
            </div>

            <!-- ✅ Table Wrapper -->
            <div class="overflow-x-auto bg-white rounded shadow-sm">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-4 py-3">Sr No.</th>
                            <th class="px-4 py-3">Product Code</th>
                            <th class="px-4 py-3">Product Name</th>
                            <th class="px-4 py-3 text-center">Quantity</th>
                            <th class="px-4 py-3">Unit Price</th>
                            <th class="px-4 py-3">Discount</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php $grandTotal = 0; @endphp
                        @foreach($cart->OrderItem as $product)
                            @php
                                $total = ($product->product_price - ($product->product_price * $product->price_off) / 100) * $product->quantity;
                                $grandTotal += $total;
                            @endphp
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $product->product_code }}</td>
                                <td class="px-4 py-3">{{ $product->product_name }}</td>
                                <td class="px-4 py-3 text-center">{{ $product->quantity }}</td>
                                <td class="px-4 py-3">Rs. {{ $product->product_price }}</td>
                                <td class="px-4 py-3">{{ $product->price_off }}%</td>
                                <td class="px-4 py-3 font-semibold">Rs. {{ number_format($total) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-right font-semibold text-lg">Grand Total:</td>
                            <td colspan="2" class="px-4 py-3 text-right font-bold text-lg text-green-700">
                                Rs. {{ number_format($grandTotal) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><br>
            <div class="mt-6 text-center">
                <a href="{{ route('order.list') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-6 py-2 rounded-md shadow transition">
                    ← Back to My Orders
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
