<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	Roles / create
	        </h2>
	        <a href="{{route('role.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">back</a>
        </div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:py-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<form action="{{route('role.store')}}" method="post">
						@csrf
						<label class="text-lg font-medium"><h3><b>Name</b></h3></label>
						<input value="{{old('name')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" type="text" name="name" autofocus placeholder="Enter name">
						@error('name')
							<p class="text-red-400 font-medium">{{$message}}</p>
						@enderror
						<br>
						<div class="grid grid-cols-4 mb-3">
							@if($role->isnotEmpty())
							@foreach($role as $userrole)
								<div class="mt-2">
									<input type="checkbox" id="permission-{{$userrole->id}}" name="permission[]" class="rounded" value="{{$userrole->name}}">
									<label for="permission-{{$userrole->id}}">	{{$userrole->name}}
									</label>
								</div>
							@endforeach
						@endif
						</div>
						<button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>


	