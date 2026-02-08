<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Http\Livewire\Traits\WithCaching;
use App\Http\Livewire\Traits\WithFiltering;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination, WithCaching, WithFiltering;

    public $search = '';
    public $category = null;
    public $minPrice = 0;
    public $maxPrice = 10000000;
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => null],
        'minPrice' => ['except' => 0],
        'maxPrice' => ['except' => 10000000],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->with(['category', 'skus'])
            ->when($this->search, function ($query) {
                $query->where('product_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('category_slug', $this->category);
                });
            })
            ->when($this->minPrice || $this->maxPrice, function ($query) {
                $query->whereHas('skus', function ($q) {
                    $q->whereBetween('sku_price', [$this->minPrice, $this->maxPrice]);
                });
            })
            ->when($this->sort === 'latest', fn($q) => $q->latest())
            ->when($this->sort === 'price_asc', function ($query) {
                $query->join('skus', 'products.product_id', '=', 'skus.product_id')
                    ->orderBy('skus.sku_price', 'asc')
                    ->select('products.*');
            })
            ->when($this->sort === 'price_desc', function ($query) {
                $query->join('skus', 'products.product_id', '=', 'skus.product_id')
                    ->orderBy('skus.sku_price', 'desc')
                    ->select('products.*');
            })
            ->paginate(12);

        $categories = $this->cache('categories', function () {
            return Category::all();
        });

        return view('livewire.shop', [
            'products' => $products,
            'categories' => $categories
        ])->layout('layouts.app');
    }
}
