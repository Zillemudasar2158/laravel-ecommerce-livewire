<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Category') }}
            </h2>
            <a href="{{route('category.create')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            {{-- Category Table --}}
            <h1 class="text-center text-2xl font-bold text-[#1C2331] mb-6">Shop by Category</h1>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">Sr No.</th>
                        <th class="px-6 py-3 text-left">Category Name</th>
                        <th class="px-6 py-3 text-left">Sub Categories</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($paginatedCategories as $cat)
                   <tr class="border-b">
                        <td class="px-6 py-3 text-left">{{ $paginatedCategories->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3 text-left"> {{$cat->cat_name}}</td>
                        <td  class="px-6 py-3 text-left">
                            @foreach($cat->subcategories as $subcat)
                                {{$subcat->subcat_name}},
                            @endforeach
                        </td>
                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('category.edit', $cat->id) }}" class="bg-slate-700 text-sm text-white px-4 py-2 rounded-md hover:bg-slate-600 transition">Edit</a>

                                <form action="{{ route('category.destory', $cat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-sm text-white px-4 py-2 rounded-md hover:bg-red-500 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                   </tr>
                @endforeach
                </tbody>
            </table>  

            <div class="mt-4">
                {{ $paginatedCategories->links() }}
            </div> 

            {{-- Subcategory Table --}}
            <h1 class="text-center text-2xl font-bold text-[#1C2331] my-10">Shop by Sub-Category</h1>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">Sr No.</th>
                        <th class="px-6 py-3 text-left">Category Name</th>
                        <th class="px-6 py-3 text-left">Sub Category</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($paginatedSubcategories as $subcat)
                   <tr class="border-b">
                        <td class="px-6 py-3 text-left">{{ $paginatedSubcategories->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3 text-left"> {{$subcat->category->cat_name ?? 'N/A'}}</td>
                        <td class="px-6 py-3 text-left"> {{$subcat->subcat_name}}</td>
                        <td class="px-6 py-3 text-center">
                            <a href="#" class="bg-slate-700 text-sm text-white px-4 py-2 rounded-md hover:bg-slate-600 transition">Edit</a>
                            <form action="{{ route('subcat.destory',$subcat->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="bg-red-600 text-sm text-white px-4 py-2 rounded-md hover:bg-red-500 transition">
                                    Delete
                                </button>
                            </form>
                        </td> 
                   </tr>
                @endforeach
                </tbody>
            </table>  

            <div class="mt-4">
                {{ $paginatedSubcategories->links() }}
            </div> 

        </div>
    </div>
</x-app-layout>
