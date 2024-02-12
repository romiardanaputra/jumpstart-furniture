<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class BestProduct extends Component
{
    public function render()
    {
        return view('components.best-product', [
            'products' => Product::all(),
        ]);
    }
}
