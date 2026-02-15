<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Blog;

class Dashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('features.user.dashboard', [
            'products' => Product::latest()->paginate(6, ['*'], 'productsPage'),
            'blogs' => Blog::latest()->paginate(2, ['*'], 'blogsPage'),
        ])->layout('layouts.app-user');
    }
}
