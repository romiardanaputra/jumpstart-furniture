<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cart_id;

    public $total_payment;

    public $subtotal_payment;

    public $special_instruction;

    public function mount()
    {
        $this->sub_total();
    }

    public function incrementQuantity($cart_id, $product_id)
    {
        $cart = ModelsCart::firstWhere('cart_id', $cart_id);
        $product = Product::firstWhere('product_id', $product_id);
        if ($cart->quantity < 10) {
            $cart->quantity++;
            $cart->total_price = $cart->quantity * $product->product_price;
            $cart->save();
            $this->sub_total();
        }
    }

    public function decrementQuantity($cart_id, $product_id)
    {
        $cart = ModelsCart::firstWhere('cart_id', $cart_id);
        $product = Product::firstWhere('product_id', $product_id);
        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->total_price = $cart->quantity * $product->product_price;
            $cart->save();
            $this->sub_total();
        }
    }

    public function sub_total()
    {
        $cart = ModelsCart::where('user_id', auth()->user()->id)->get();
        $this->subtotal_payment = $cart->sum(function ($cart) {
            return $cart->total_price;
        });
    }

    public function add_special_instruction()
    {
        $carts = ModelsCart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $cart->special_instruction = $this->special_instruction;
            $cart->save();
        }

        return to_route('info-status');
    }

    public function delete_cart($cart_id)
    {
        ModelsCart::where('cart_id', $cart_id)->delete();

        return to_route('shopping-cart');
    }

    public function render()
    {
        return view('livewire.shopping-cart', [
            'carts' => ModelsCart::all(),
        ]);
    }
}
