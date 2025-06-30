<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	Category / edit
	        </h2>
	        <a href="{{route('category.list')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">back</a>
        </div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:py-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<form action="{{route('category.update',$category->id)}}" method="post">
						@csrf
						@method('PUT')
						<label class="text-lg font-medium"><h3><b>Name</b></h3></label>
						<input value="{{old('category',$category->cat_name)}} " class="border-gray-300 shadow-sm w-1/2 rounded-lg" type="text" name="category">
						@error('category')
							<p class="text-red-400 font-medium">{{$message}}</p>
						@enderror
						<br><br>

						<button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>


	