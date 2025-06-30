<div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Parent Dropdown Button -->
   <button @click="open = !open" class="text-white text-sm px-1 py-1 bg-[#1C2331] rounded-md inline-flex items-center">
        Category
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Main Dropdown -->
    <div x-show="open" @click.away="open = false" x-transition class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
        @if(!empty($navcat))
        @foreach($navcat as $cat)
        <div class="relative group">
            <a href="{{route('catproduct', ['id' => $cat->id])}}" 
               class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                {{$cat->cat_name}}
                <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @if(!empty($cat->subcategories))
            <!-- Submenu (stays visible as long as mouse is in group) -->
            <div class="absolute left-full top-0 mt-0 ml-1 w-40 bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-200 z-50">

            @foreach($cat->subcategories as $subcat)
                <a href="{{route('catproduct', ['id' => $cat->id.'&'.$subcat->id])}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{$subcat->subcat_name}}</a>
            @endforeach
            </div>
            @endif
        </div>
        @endforeach
        @endif

    </div>
</div>
