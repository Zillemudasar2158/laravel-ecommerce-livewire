<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	{{ __('Users') }}
	        </h2>
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
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
            			<th class="px-6 py-3 text-left">Created</th>
                        @can('edit users')
            			<th class="px-6 py-3 text-center">Action</th>
                        @endcan
            		</tr>
            	</thead>
            	<tbody class="bg-white">
            	@if($user->isnotEmpty())
            		@foreach($user as $users)
            			<tr class="border-b">
	            			<td class="px-6 py-3 text-left">{{$loop->iteration+ ($user->currentPage() - 1) * $user->perPage()}}</td>
                            <td class="px-6 py-3 text-left">{{$users->name}}</td>
                            <td class="px-6 py-3 text-left">{{$users->email}}</td>
                            <td class="px-6 py-3 text-left">{{$users->roles->pluck('name')->implode(', ')}} 
                            </td>
	            			<td class="px-6 py-3 text-left">{{\Carbon\Carbon::parse($users->created_at)->format('d M,Y')}}</td>
                            @can('edit users')
                            <td class="px-6 py-3 text-center">
                                <a href="{{route('user.edit',$users->id)}} " class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
	            			</td>
                            @endcan
            			</tr>
            		@endforeach
            	@endif
            	</tbody>
            </table>
            <div class="mt-3">
                {{ $user->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
