<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Coupon;

class Couponremove extends Component
{
	public $couponId;

	public function mount($couponId)
	{
		$this->couponId=$couponId;
	}
	public function delete()
	{
		$coupon=Coupon::findOrFail($this->couponId);

		if ($coupon) {
			$coupon->delete();
			$this->dispatch('coupon-deleted'); 
			session()->flash('success','Coupon deleted successfully');
		}
		else 
		{
            session()->flash('error', 'Coupon not found.');
        }
	}

    public function render()
    {
        return view('livewire.couponremove');
    }
}
