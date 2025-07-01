<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-message />

            @if($orders->isNotEmpty())
                <p class="text-center text-lg md:text-xl font-medium mt-4">
                    <u>Enter Order ID to track order</u>
                </p><br>

                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto bg-white rounded-md shadow">
                    <table class="min-w-full border border-gray-300 text-sm text-left">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-center">#</th>
                                <th class="px-4 py-3">Order No</th>
                                <th class="px-4 py-3">Total amount</th>
                                <th class="px-4 py-3">Coupon code</th>
                                <th class="px-4 py-3">Discount</th>
                                <th class="px-4 py-3">Payment</th>
                                <th class="px-4 py-3">Shipping</th>
                                <th class="px-4 py-3">Status</th>
                                @canany(['edit products','delete products'])
                                    <th class="px-4 py-3 text-center">Actions</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition text-sm">
                                    <td class="px-4 py-2 text-center font-medium text-gray-800">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <a href="{{ route('orderdetail.list', $order->order_number) }}"
                                           class="text-blue-600 hover:underline hover:text-blue-800 font-sm flex items-center gap-1"
                                           title="Click to detail this order">
                                             {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 font-semibold text-gray-800 whitespace-nowrap">
                                        Rs. {{ $order->total_amount }}
                                    </td>
                                    <td class="px-4 py-2 font-semibold text-gray-800 whitespace-nowrap">
                                         {{ $order->coupon_code }}
                                    </td>
                                    <td class="px-4 py-2 font-semibold text-gray-800 whitespace-nowrap">
                                        Rs. {{ $order->discount }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                                        {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Credit / Debit Card' }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-600 truncate max-w-[200px]">{{ $order->shipping_address }}</td>
                                    <td class="px-4 py-2">
                                        <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                               ($order->status === 'delivered' ? 'bg-green-100 text-green-800' :
                                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    @canany(['edit products','delete products'])
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex flex-col md:flex-row justify-center items-center space-y-2 md:space-y-0 md:space-x-2">
                                                @can('edit products')
                                                    <a href="{{route('order.edit',$order->id)}}">
                                                        <button type="submit"
                                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-medium w-full md:w-auto">
                                                            Edit
                                                        </button>
                                                    </a>
                                                @endcan
                                                @can('delete products')
                                                    <livewire:orderremove :orderId="$order->id" key="$order->id">
                                                @endcan
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-lg md:text-xl font-medium mt-4">No orders found</p>
            @endif
        </div>
    </div>
</x-app-layout>
