<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class InfoStatus extends Component
{
    public $subtotal_payment;

    public $shipping_address;

    public $count_existing_product;

    public function mount()
    {
        $this->sub_total();
    }

    public function back_to_cart_page()
    {
        return to_route('shopping-cart');
    }

    public function shipping()
    {
        return to_route('shipping', $parameter = ['shipping_address' => $this->shipping_address]);
    }

    public function shipping_method_calculation()
    {
        $orders = ModelsCart::where('user_id', auth()->user()->id)->get();
        foreach ($orders as $order) {
            if ($order->product->product_shipping_and_return == 'exclusive') {
                return 40;
            } elseif ($order->product->product_shipping_and_return == 'standard') {
                return 20;
            } else {
                dd('not selected');
            }
        }
    }

    public function sub_total()
    {
        $total = ModelsCart::where('user_id', auth()->user()->id)->sum('total_price');

        return $this->subtotal_payment = $total;
    }

    public function render()
    {
        return view('features.admin.info-status', [
            'info_status' => ModelsCart::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
