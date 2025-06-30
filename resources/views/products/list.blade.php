<x-app-layout>
    	@can('create products')
    <x-slot name="header">
        <div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	{{ __('Products') }}
	        </h2>
	        
	        <a href="{{route('product.create')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
	        
        </div>
    </x-slot>
@endcan
    <div class="py-12 bg-gray-100">
	    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
	        <x-message></x-message>
			@foreach($categories as $cat)
			@php
		        $subs = $subcategories ?? $cat->subcategories;
		        
		    @endphp
			<br>
			<div class="px-4 py-3 rounded-lg shadow mb-6 border-l-4 border-[#1C2331]">
			    <h2 class="text-xl font-bold text-[#1C2331] flex items-center gap-2">
			        <i class="fa fa-tags text-[#1C2331]"></i>
			        {{ $cat->cat_name }}

			    </h2>
			</div>
			@foreach($subs as $sub)
			    @if($sub->products->count())
			     	
			        <br>
			        <h3 class="text-lg font-semibold text-[#1C2331] my-2 ml-2">
			            ➤ Subcategory: {{ $sub->subcat_name }}
			        </h3>
			        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
			        	
			            @foreach($sub->products as $item)
			                <div class="bg-white rounded-xl shadow-md p-5 text-center hover:shadow-lg transition relative">
			                    @if($item->price_off > 0)
			                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full z-10 shadow">
			                            {{ $item->price_off }}% OFF
			                        </div>
			                    @endif

			                    <div class="absolute top-2 right-2 bg-gray-600 text-white text-xs px-2 py-1 z-10 rounded shadow">
							        Code: {{ $item->product_code }}
							    </div>

			                    <img src="{{ asset('product/'.$item->img_path) }}" alt="Product Image"
			                         class="mx-auto mb-4 w-full h-48 object-cover rounded transition-transform duration-300"
			                         onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'">

			                    <h3 class="text-md h-12 font-semibold text-gray-800 mb-1">{{ $item->name }}</h3>

			                    <p class="text-gray-600 text-sm mb-1">
			                        <span class="font-medium">Price:</span>
			                        @if($item->price_off > 0)
			                            <del>Rs. {{ $item->price }}</del>
			                            <span class="text-green-600 font-bold">
			                                Rs. {{ $item->price - ($item->price * $item->price_off / 100) }}
			                            </span>
			                        @else
			                            Rs. {{ $item->price }}
			                        @endif
			                    </p>

			                    <div class="text-xs text-gray-500 mb-3 italic">
							        {{ $cat->cat_name }} &raquo; {{ $sub->subcat_name }}
							    </div>

							    <!-- add to cart setting -->
							    <livewire:add-to-cart :productId="$item->id" :key="$item->id" /><br>
								
			                    <div class="flex justify-center gap-2">
			                        @can('edit products')
			                            <a href="{{route('product.edit',$item->id)}}" class="bg-slate-700 text-sm text-white px-4 py-2 rounded-md hover:bg-slate-600 transition">Edit</a>
			                        @endcan
			                        @can('delete products')
			                            <form action="{{ route('product.destroy', $item->id) }}" method="POST" style="display:inline-block;">
									    @csrf
									    @method('DELETE')
									    <button type="submit" class="bg-red-600 text-sm text-white px-4 py-2 rounded-md hover:bg-red-500 transition">
									        Delete
									    </button>
									</form>

			                        @endcan
			                    </div>
			                    </div>
			                @endforeach
			            </div>
			        @endif
				@endforeach
			@endforeach
	    </div>
	</div>

</x-app-layout>
