<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Blog;

class Landing extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('features.shop.landing', [
            'products' => Product::latest()->paginate(10, ['*'], 'productsPage'),
            'blogs' => Blog::latest()->paginate(6, ['*'], 'blogsPage'),
        ]);
    }
}
