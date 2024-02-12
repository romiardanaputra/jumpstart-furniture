<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class Shipping extends Component
{
    public $shipping_address;

    public $shipping_method;

    public function mount()
    {
        $this->shipping_address = request()->shipping_address;
    }

    public function back_to_info_status_page()
    {
        return to_route('info-status');
    }

    public function payment()
    {
        return to_route('payment', $parameter = [
            'shipping_method' => $this->shipping_method,
            'shipping_address' => $this->shipping_address,
        ]);
    }

    public function render()
    {
        return view('livewire.shipping', [
            'data_shipping' => ModelsCart::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
