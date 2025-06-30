<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	{{ __('Roles') }}
	        </h2>
            @can('create roles')
	        <a href="{{route('role.create')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        	<x-message></x-message>
            <table class="w-full">
            	<thead class="bg-gray-50">
            		<tr class="border-b">
            			<th class="px-6 py-3 text-left">Sr No.</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Permission assign</th>
            			<th class="px-6 py-3 text-left">Created</th>
                        @canany(['edit roles','delete roles'])
            			<th class="px-6 py-3 text-center" colspan="2">Action</th>
                        @endcanany
            		</tr>
            	</thead>
            	<tbody class="bg-white">
            	@if($role->isnotEmpty())
            		@foreach($role as $user)
            			<tr class="border-b">
	            			<td class="px-6 py-3 text-left">{{$loop->iteration + ($role->currentPage() - 1) * $role->perPage()}}</td>
                            <td class="px-6 py-3 text-left">{{$user->name}}</td>
                            <td class="px-6 py-3 text-left">{{$user->permissions->pluck('name')->implode(', ')}} 
                            </td>
	            			<td class="px-6 py-3 text-left">{{\Carbon\Carbon::parse($user->created_at)->format('d M,Y')}}</td>
                            @can('edit roles')
                            <td class="text-center">
	            				<a href="{{route('role.edit',$user->id)}} " class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                            </td>
                            @endcan
                            @can('delete roles')
                            <td class="text-center">
	            				<a href="{{route('role.destory',$user->id)}} " class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-600">Delete</a>
	            			</td>
                            @endcan
            			</tr>
            		@endforeach
            	@endif
            	</tbody>
            </table>
            <div class="mt-3">
                
            </div>
        </div>
    </div>
</x-app-layout>
