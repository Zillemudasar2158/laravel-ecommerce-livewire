<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;

class Orderremove extends Component
{
	public $orderId;

	public function removeItem()
	{
		$order=Order::findOrFail($this->orderId); 
		if ($order) {
			$order->delete();
			return redirect()->route('allorder.list')->with('success','Order deleted successfully!');
		}
	} 
    public function render()
    {
        return view('livewire.orderremove');
    }
}
