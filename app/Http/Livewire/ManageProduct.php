<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProducts;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageProduct extends Component
{
    use WithFileUploads;

    public $product_name;

    public $product_rating;

    public $product_price;

    public $product_short_description;

    public $product_type;

    public $product_sku;

    public $product_vendor;

    public $product_availability;

    public $product_tags;

    public $product_color;

    public $product_material;

    public $product_long_description;

    public $product_shipping_and_return;

    public $product_image;

    public $product_discount;

    public $product_id;

    public $product;

    public $title_form = 'Create Product';

    protected $rules = [
        'product_name' => ['required'],
        'product_rating' => [''],
        'product_price' => ['required'],
        'product_short_description' => ['required'],
        'product_type' => ['required'],
        'product_sku' => ['required'],
        'product_vendor' => ['required'],
        'product_availability' => ['required'],
        'product_tags' => ['required'],
        'product_color' => ['required'],
        'product_material' => ['required'],
        'product_long_description' => ['required'],
        'product_shipping_and_return' => ['required'],
        'product_discount' => ['required'],
        'product_image' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
    ];

    public function store_or_update_product()
    {
        $this->validate();
        if ($this->product_id) {
            $product = ModelsProducts::find($this->product_id);
            $product->update([
                'product_name' => $this->product_name,
                'product_rating' => $this->product_rating,
                'product_price' => $this->product_price,
                'product_short_description' => $this->product_short_description,
                'product_type' => $this->product_type,
                'product_sku' => $this->product_sku,
                'product_vendor' => $this->product_vendor,
                'product_availability' => $this->product_availability,
                'product_tags' => $this->product_tags,
                'product_color' => $this->product_color,
                'product_material' => $this->product_material,
                'product_long_description' => $this->product_long_description,
                'product_shipping_and_return' => $this->product_shipping_and_return,
                'product_discount' => $this->product_discount,
                'product_image' => $this->product_image->store('product_image'),
            ]);
        } else {
            ModelsProducts::create([
                'user_id' => auth()->user()->id,
                'product_name' => $this->product_name,
                'product_rating' => $this->product_rating,
                'product_price' => $this->product_price,
                'product_short_description' => $this->product_short_description,
                'product_type' => $this->product_type,
                'product_sku' => $this->product_sku,
                'product_vendor' => $this->product_vendor,
                'product_availability' => $this->product_availability,
                'product_tags' => $this->product_tags,
                'product_color' => $this->product_color,
                'product_material' => $this->product_material,
                'product_long_description' => $this->product_long_description,
                'product_shipping_and_return' => $this->product_shipping_and_return,
                'product_discount' => $this->product_discount,
                'product_image' => $this->product_image->store('product_image'),
            ]);
        }

        return to_route('manage-product');
    }

    public function edit_product($product_id)
    {
        $this->product_id = $product_id;
        $product = ModelsProducts::find($this->product_id);
        $this->title_form = 'Update Product '.$product->product_name;
        $this->product_name = $product->product_name;
        $this->product_rating = $product->product_rating;
        $this->product_price = $product->product_price;
        $this->product_short_description = $product->product_short_description;
        $this->product_type = $product->product_type;
        $this->product_sku = $product->product_sku;
        $this->product_vendor = $product->product_vendor;
        $this->product_availability = $product->product_availability;
        $this->product_tags = $product->product_tags;
        $this->product_color = $product->product_color;
        $this->product_material = $product->product_material;
        $this->product_long_description = $product->product_long_description;
        $this->product_shipping_and_return = $product->product_shipping_and_return;
        $this->product_discount = $product->product_discount;
        $this->product_image = $product->product_image;
    }

    public function switch_form_to_create()
    {
        $this->product_id = '';
        $this->product_name = '';
        $this->product_rating = '';
        $this->product_price = '';
        $this->product_short_description = '';
        $this->product_type = '';
        $this->product_sku = '';
        $this->product_vendor = '';
        $this->product_availability = '';
        $this->product_tags = '';
        $this->product_color = '';
        $this->product_material = '';
        $this->product_long_description = '';
        $this->product_shipping_and_return = '';
        $this->product_discount = '';
        $this->product_image = '';
        $this->title_form = 'Create Product';
    }

    public function delete_product($product_id)
    {
        ModelsProducts::where('product_id', $product_id)->delete();

        return to_route('manage-product');
    }

    public function render()
    {
        return view('livewire.manage-product', [
            'products' => ModelsProducts::all(),
        ]);
    }
}
