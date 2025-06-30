<div x-data="{ count: 1 }" >
    <button type="button" 
            @click="count = count > 1 ? count - 1 : 1"
            class="px-3 py-1 bg-gray-300 rounded text-xl font-bold hover:bg-gray-400">
        −
    </button>
    <input type="text" name="quantity" x-model="count"
           min="1" max="10"
           class="w-10 text-center border rounded px-2 py-1 focus:outline-none focus:ring focus:ring-blue-200" readonly/>
    @error('quantity')
    	{{$message}}
    @enderror
    <button type="button" 
            @click="count = count < 10 ? count + 1 : 10"
            class="px-3 py-1 bg-gray-300 rounded text-xl font-bold hover:bg-gray-400">
        +
    </button>
</div>
<br>
@auth
<button type="submit" class="inline-block mb-3 px-5 py-2 bg-[#1C2331] text-white rounded-md hover:bg-[#2c3e50] text-sm font-medium transition">
    Add to cart
</button>
@else
<a href="/login" class="inline-block mb-3 px-5 py-2 bg-[#1C2331] text-white rounded-md hover:bg-[#2c3e50] text-sm font-medium transition">
    Login to add this item
</a>
@endauth
