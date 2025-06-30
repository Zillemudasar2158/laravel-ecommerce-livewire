<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	Category--Subcategory / create
	        </h2>
	        <a href="{{route('category.list')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">back</a>
        </div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:py-6 lg:px-8">
			<div class="overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl max-w-2xl mx-auto">
				    @csrf
				    <h2 class="text-2xl font-bold mb-6 text-center text-[#1C2331]">Add New Category</h2>

				    {{-- Category Name--}}
					<div class="mb-4">
				        <label class="block text-gray-700 font-semibold mb-1">Category Name</label>
				        <input type="text" name="category" value="{{ old('category') }}"
				               class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
				               placeholder="Enter category name">
				        @error('category')
				            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
				        @enderror
				    </div>

				    {{-- Submit Button --}}
				    <div class="text-center">
				        <button type="submit"
				                class="bg-[#1C2331] hover:bg-[#2c3e50] text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
				            Add Category
				        </button>
				    </div>
				</form>

				</div>
			</div>

			<!-- subcategory form -->
			<div class="overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<form action="{{route('subcat.store')}}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl max-w-2xl mx-auto">
				    @csrf
				    <h2 class="text-2xl font-bold mb-6 text-center text-[#1C2331]">Add sub Category</h2>

				    {{-- Category Name--}}
					<div class="mb-4 flex gap-4">

				    <div class="w-1/2">
				        <label class="block text-gray-700 font-semibold mb-1">Category Name</label>
				        <select name="category_id" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
				            <option value="" disabled selected>Please Select Category</option>
				            @foreach ($categories as $cat)
				                <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
				            @endforeach
				        </select>
				        @error('category_id')
				        	<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
				        @enderror
				    </div>

				    <!-- Sub Category Input -->
				    <div class="w-1/2">
				        <label class="block text-gray-700 font-semibold mb-1">Sub Category Name</label>
				        <input type="text" name="subcat" value="{{ old('subcat') }}"
				               class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
				               placeholder="Enter sub-category name">
				        @error('subcat')
				            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
				        @enderror
				    </div>

				</div>

				    {{-- Submit Button --}}
				    <div class="text-center">
				        <button type="submit"
				                class="bg-[#1C2331] hover:bg-[#2c3e50] text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
				            Add Sub-Category
				        </button>
				    </div>
				</form>

				</div>
			</div>
		</div>
	</div>
</x-app-layout>


	