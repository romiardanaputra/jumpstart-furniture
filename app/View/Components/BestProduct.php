<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class BestProduct extends Component
{
    public $products;

    public function __construct($products = null)
    {
        $this->products = $products ?? Product::latest()->paginate(10);
    }

    public function render()
    {
        return view('components.best-product');
    }
}
