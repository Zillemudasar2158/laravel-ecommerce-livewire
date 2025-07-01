<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Coupon
            </h2>
            <a href="{{ route('coupon.list') }}" class="bg-slate-700 text-sm rounded-md text-white px-4 py-2">
                ← Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('coupon.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Coupon Type -->
                    <div>
                        <label for="coupontype" class="block text-lg font-medium text-gray-700 mb-1">Coupon Type</label>
                        <select name="coupontype" id="coupontype" class="w-1/2 border-gray-300 rounded-lg shadow-sm">
                            <option value="fixed">Fixed</option>
                            <option value="percent">Percent</option>
                        </select>
                    </div>

                    <!-- Coupon Value -->
                    <div>
                        <label for="value" class="block text-lg font-medium text-gray-700 mb-1">Value</label>
                        <input type="text" name="value" id="value" value="{{ old('value') }}"
                            placeholder="Enter value (e.g. 200 or 10)"
                            class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-slate-300" />
                        @error('value')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Coupon Days -->
                    <div>
                        <label for="day" class="block text-lg font-medium text-gray-700 mb-1">Valid days</label>
                        <input type="date" name="day" id="day" value="{{ old('value') }}" class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-slate-300" />
                        @error('day')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="bg-slate-700 hover:bg-slate-800 text-white px-6 py-3 rounded-md text-base font-medium transition duration-200">
                            ➕ Add Coupon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
