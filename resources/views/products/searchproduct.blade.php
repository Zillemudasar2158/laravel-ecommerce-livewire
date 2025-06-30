<x-app-layout>
    <div class="py-10 bg-gray-100">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6 md:flex md:items-center gap-6">

            {{-- Product Image --}}
            <div class="flex-shrink-0 flex justify-center md:justify-start w-full md:w-[350px]">
                <img src="{{ asset('product/'.$product->img_path) }}" alt="{{ $product->name }}"
                     class="w-[350px] h-[350px] object-contain rounded border transition-transform duration-300"
                     onmouseover="this.style.transform='scale(1.05)'" 
                     onmouseout="this.style.transform='scale(1)'">
            </div>

            {{-- Product Info --}}
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>

                <p class="text-sm text-gray-500 mb-3">
                    <span class="font-semibold text-gray-700">Product Code:</span>
                    <span class="bg-emerald-100 text-emerald-700 font-mono px-2 py-1 rounded">
                        {{ $product->product_code }}
                    </span>
                </p>

                {{-- Price and Discount --}}
                <div class="mb-4">
                    @if($product->price_off > 0)
                        <p class="text-xl font-semibold text-green-600">
                            Rs. {{ $product->price - ($product->price * $product->price_off / 100) }}
                            <span class="text-sm text-gray-500 line-through ml-2">
                                Rs. {{ $product->price }}
                            </span>
                        </p>
                        <span class="inline-block mt-1 px-2 py-1 text-xs bg-red-600 text-white rounded">
                            {{ $product->price_off }}% OFF
                        </span>
                    @else
                        <p class="text-xl font-semibold text-gray-800">
                            Rs. {{ $product->price }}
                        </p>
                    @endif
                </div>

                {{-- Category Info --}}
                <p class="text-sm text-gray-600 mb-1">
                    <span class="font-medium text-gray-700">Category:</span>
                    {{ $product->subcategory->category->cat_name ?? '-' }}
                </p>
                <p class="text-sm text-gray-600 mb-5">
                    <span class="font-medium text-gray-700">Subcategory:</span>
                    {{ $product->subcategory->subcat_name ?? '-' }}
                </p>

                <!-- add to cart setting -->
                <form action="{{route('cart.store')}}" method="POST">
                @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <x-cart />
                </form>

                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                @can('edit products')
                    <a href="{{route('product.edit',$product->id)}}" class="bg-slate-700 text-sm text-white px-4 py-2 rounded-md hover:bg-slate-600 transition">Edit</a>
                @endcan
                @can('delete products')
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-sm text-white px-4 py-2 rounded-md hover:bg-red-500 transition">
                        Delete
                    </button>
                </form>
                @endcan
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
