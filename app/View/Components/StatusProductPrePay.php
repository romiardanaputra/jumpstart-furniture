<?php

namespace App\View\Components;

use App\Models\Cart as ModelsCart;
use Illuminate\View\Component;

class StatusProductPrePay extends Component
{
    public function render()
    {
        $total = ModelsCart::where('user_id', auth()->user()->id)->sum('total_price');
        $ship_method = (request()->shipping_method == 'exclusive' ? 40 : 20);
        $pay = $total + $ship_method;

        return view('components.status-product-pre-pay', [
            'info_status' => ModelsCart::where('user_id', auth()->user()->id)->get(),
            'items' => ModelsCart::all(),
            'total' => app('App\Http\Livewire\InfoStatus')->sub_total(),
            'shipping_price' => $ship_method,
            'payment' => $pay,
        ]);
    }
}
