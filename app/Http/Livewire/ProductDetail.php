<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product as ModelsProduct;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $selectedSku;
    public $selectedAttributes = [];
    public $quantity = 1;
    public $reviews;
    public $averageRating = 0;

    protected $listeners = ['reviewAdded' => 'loadReviews'];

    public function mount($product_id)
    {
        $this->product = ModelsProduct::with(['skus.attributeValues.attribute', 'category'])->findOrFail($product_id);
        
        // Select first SKU by default
        $this->selectedSku = $this->product->skus->first();
        
        if ($this->selectedSku) {
            foreach ($this->selectedSku->attributeValues as $val) {
                $this->selectedAttributes[$val->attribute->attribute_id] = $val->attribute_value_id;
            }
        }

        $this->loadReviews();
    }

    public function loadReviews()
    {
        $this->reviews = \App\Models\Review::where('product_id', $this->product->product_id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $this->averageRating = $this->reviews->avg('rating') ?? 0;
    }

    public function selectAttribute($attributeId, $valueId)
    {
        $this->selectedAttributes[$attributeId] = $valueId;
        
        // Find SKU that matches all selected attributes
        $matchingSku = $this->product->skus->filter(function($sku) {
            $skuValues = $sku->attributeValues->pluck('attribute_value_id')->toArray();
            foreach ($this->selectedAttributes as $attrId => $valId) {
                if (!in_array($valId, $skuValues)) return false;
            }
            return true;
        })->first();

        if ($matchingSku) {
            $this->selectedSku = $matchingSku;
        }
    }

    /**
     * Increment item quantity
     */
    public function increment(): void
    {
        $this->quantity++;
    }

    /**
     * Decrement item quantity
     */
    public function decrement(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!$this->selectedSku) return;

        ModelsCart::create([
            'user_id' => auth()->id(),
            'product_id' => $this->product->product_id,
            'sku_id' => $this->selectedSku->sku_id, // We need to add this column to carts table
            'total_price' => $this->selectedSku->sku_price * $this->quantity,
            'quantity' => $this->quantity,
        ]);

        $this->emit('cartUpdated');
        return to_route('shopping-cart');
    }

    public function render()
    {
        return view('features.shop.product-detail', [
            'product' => $this->product,
            'sku' => $this->selectedSku,
            'availableAttributes' => $this->getAvailableAttributes(),
        ]);
    }

    protected function getAvailableAttributes()
    {
        $attributes = [];
        foreach ($this->product->skus as $sku) {
            foreach ($sku->attributeValues as $val) {
                $attributes[$val->attribute->attribute_name]['id'] = $val->attribute->attribute_id;
                $attributes[$val->attribute->attribute_name]['values'][$val->attribute_value_id] = $val->attribute_value_name;
            }
        }
        return $attributes;
    }
}
