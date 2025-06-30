<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	Order / edit
	        </h2>
	        <a href="{{route('order.list')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">back</a>
        </div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:py-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="flex justify-center items-center bg-gray-100">
				    <div class="w-full max-w-xl bg-white rounded-lg shadow-md p-8">
				        <form action="{{ route('order.update', $order->id) }}" method="POST" class="space-y-6">
				            @csrf
				            @method('PUT')
				            <div>
				                <label class="block text-lg font-semibold text-gray-800 mb-1">Order Number</label>
				                <input value="{{ old('order', $order->order_number) }}" 
				                    class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm bg-gray-100 text-gray-700" 
				                    type="text" name="order" readonly>
				            </div>
				            <div>
				                <label class="block text-lg font-semibold text-gray-800 mb-1">Update Status</label>
				                <select name="paymentstatus" id="status-{{ $order->id }}" 
				                    class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm text-gray-700">
				                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
				                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
				                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
				                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
				                </select>
				            </div>

				            <div class="text-center">
				                <button type="submit"
				                    class="bg-slate-700 hover:bg-slate-700 text-white font-medium px-6 py-2 rounded-md transition duration-200">
				                    Update
				                </button>
				            </div>
				        </form>
				    </div>
				</div>

			</div>
		</div>
	</div>
</x-app-layout>


	