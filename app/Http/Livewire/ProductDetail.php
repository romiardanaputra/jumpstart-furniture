<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product as ModelsProduct;
use Livewire\Component;

class ProductDetail extends Component
{
    public $user_id;

    public $special_instruction;

    public function store_cart($product_id, $product_price)
    {
        ModelsCart::create([
            'product_id' => $product_id,
            'user_id' => auth()->user()->id,
            'total_price' => $product_price,
            'quantity' => 1,
        ]);

        return to_route('shopping-cart');
    }

    public function store_cart_and_buy($product_id, $product_price)
    {
        ModelsCart::create([
            'product_id' => $product_id,
            'user_id' => auth()->user()->id,
            'total_price' => $product_price,
            'quantity' => 1,
        ]);

        return to_route('info-status');
    }

    public function render()
    {
        return view('features.shop.product-detail', [
            'product' => ModelsProduct::find(request()->product_id),
        ]);
    }
}
