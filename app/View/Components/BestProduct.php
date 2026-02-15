<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class BestProduct extends Component
{
    public $products;
    public $nested;

    public function __construct($products = null, $nested = false)
    {
        $this->products = $products ?? Product::latest()->paginate(10);
        $this->nested = $nested;
    }

    public function render()
    {
        return view('components.best-product');
    }
}
