<div class="flex flex-col items-center space-y-3">
	@if (session()->has('success'))
	    <div 
	        x-data="{ show: true }" 
	        x-init="setTimeout(() => show = false, 1000)" 
	        x-show="show" 
	        x-transition.duration.500ms 
	        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50">
	        {{ session('success') }}
	    </div>
	@endif

    <div class="flex items-center space-x-2">
        <button wire:click="decrement" 
                class="px-3 py-1 bg-gray-300 rounded text-xl font-bold hover:bg-gray-400">−</button>

        <input type="text" readonly value="{{ $quantity }}"
               class="w-10 text-center border rounded px-2 py-1 focus:outline-none"/>

        <button wire:click="increment" 
                class="px-3 py-1 bg-gray-300 rounded text-xl font-bold hover:bg-gray-400">+</button>
    </div>

    @auth
        <button wire:click="addToCart" 
                class="mt-2 inline-block px-5 py-2 bg-[#1C2331] text-white rounded-md hover:bg-[#2c3e50] text-sm font-medium transition">
            Add to Cart
        </button>
    @else
        <a href="/login"
           class="mt-2 inline-block px-5 py-2 bg-[#1C2331] text-white rounded-md hover:bg-[#2c3e50] text-sm font-medium transition">
            Login to add this item
        </a>
    @endauth
    
</div>
