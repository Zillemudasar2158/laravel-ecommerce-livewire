<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Coupon') }}
            </h2>
            <a href="{{ route('coupon.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            @if($coupon->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Sr No.</th>
                            <th class="px-6 py-3 text-left">Coupon Code</th>
                            <th class="px-6 py-3 text-left">Type</th>
                            <th class="px-6 py-3 text-left">Value</th>
                            <th class="px-6 py-3 text-left">Expiry date</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($coupon as $listcoupon)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">
                                    {{ $loop->iteration + ($coupon->currentPage() - 1) * $coupon->perPage() }}
                                </td>
                                <td class="px-6 py-3 text-left">{{ $listcoupon->code }}</td>
                                <td class="px-6 py-3 text-left">{{ $listcoupon->type }}</td>
                                <td class="px-6 py-3 text-left">
                                    @if($listcoupon->type == 'percent')
                                        {{ $listcoupon->value }}%
                                    @else
                                        Rs. {{ $listcoupon->value }}
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-left">{{ $listcoupon->expires_at }}</td>
                                <td class="px-6 py-3 text-center">
                                    <livewire:couponremove :couponId="$listcoupon->id" :key="'coupon-'.$listcoupon->id" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                <div class="mt-3">
                    {{ $coupon->links() }}
                </div>
            @else
                <p class="text-center text-gray-600 py-10 text-lg">No coupons found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
