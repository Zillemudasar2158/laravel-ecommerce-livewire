<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	Product / create
	        </h2>
	        <a href="{{route('product.list')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">back</a>
        </div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:py-6 lg:px-8">
			<div class="overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl max-w-2xl mx-auto">
				    @csrf
				    <h2 class="text-2xl font-bold mb-6 text-center text-[#1C2331]">Add New Product</h2>

				    {{-- Product Name --}}
				    <div class="mb-4">
				        <label class="block text-gray-700 font-semibold mb-1">Name</label>
				        <input type="text" name="name" value="{{ old('name') }}"
				               class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
				               placeholder="Enter product name">
				        @error('name')
				            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
				        @enderror
				    </div>

				    {{-- Price & Discount in Same Row --}}
					<div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-6">
					    <div>
					        <label class="block text-gray-700 font-semibold mb-1">Price</label>
					        <input type="text" name="price" value="{{ old('price') }}"
					               class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
					               placeholder="Enter price">
					        @error('price')
					            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
					        @enderror
					    </div>

					    <div>
					        <label class="block text-gray-700 font-semibold mb-1">Discount (%)</label>
					        <select name="dis_price"
					                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
					            <option value="0">No Discount</option>
					            @for($i = 1; $i <= 100; $i++)
					                <option value="{{ $i }}" {{ old('dis_price') == $i ? 'selected' : '' }}>
					                    {{ $i }}%
					                </option>
					            @endfor
					        </select>
					        @error('dis_price')
					            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
					        @enderror
					    </div>
					</div>

					<div class="flex gap-4 w-full">
					    <!-- Sub Category Dropdown -->
					    <div class="w-full">
					        <label class="block text-gray-700 font-semibold mb-1">Category Name</label>
					        <select name="category" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
					            <option value="" disabled selected>Please Select Category</option>
					            @foreach($categories as $category)
								    @foreach($category->subcategories as $subcat)
								        <option value="{{ $subcat->id }}">{{$category->cat_name}} -> 
								        {{ $subcat->subcat_name }}
								        </option>
								    @endforeach
								@endforeach
					        </select>
					        @error('category')
					            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
					        @enderror
					    </div>
					</div>


				    {{-- Image Upload --}}
				    <div class="mb-6">
				        <label class="block text-gray-700 font-semibold mb-1">Product Image</label>
				        <input type="file" name="image"
				               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold">
				        @error('image')
				            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
				        @enderror
				    </div>

				    {{-- Submit Button --}}
				    <div class="text-center">
				        <button type="submit"
				                class="bg-[#1C2331] hover:bg-[#2c3e50] text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
				            Add Product
				        </button>
				    </div>
				</form>

				</div>
			</div>
		</div>
	</div>
</x-app-layout>


	