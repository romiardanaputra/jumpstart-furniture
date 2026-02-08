<?php

namespace App\Http\Livewire;

use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageProduct extends Component
{
    use WithFileUploads;

    public ?int $category_id = null;
    public string $product_name = '';
    public ?float $product_rating = null;
    public ?float $product_price = null;
    public string $product_short_description = '';
    public string $product_type = '';
    public string $product_vendor = '';
    public string $product_availability = '';
    public string $product_tags = '';
    public string $product_long_description = '';
    public string $product_shipping_and_return = '';
    public $product_image;
    public ?float $product_discount = 0;
    public ?int $product_id = null;
    public string $title_form = 'Create Product';

    // Variation State
    public array $skus = [];
    public $availableAttributes = [];

    protected ProductService $productService;
    protected $categoryRepo;

    /**
     * Validation rules with better security
     */
    protected array $rules = [
        'product_name' => ['required', 'string', 'max:255'],
        'product_rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
        'product_price' => ['required', 'numeric', 'min:0'],
        'product_short_description' => ['required', 'string', 'max:500'],
        'product_type' => ['required', 'string', 'max:100'],
        'product_sku' => ['required', 'string', 'max:100'],
        'product_vendor' => ['required', 'string', 'max:255'],
        'product_availability' => ['required', 'in:true,false,1,0'],
        'product_tags' => ['required', 'string', 'max:255'],
        'product_color' => ['required', 'string', 'max:100'],
        'product_material' => ['required', 'string', 'max:100'],
        'product_long_description' => ['required', 'string'],
        'product_shipping_and_return' => ['required', 'string'],
        'product_discount' => ['required', 'numeric', 'min:0', 'max:100'],
        'product_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:1024'],
    ];

    /**
     * Boot method for dependency injection
     */
    public function boot(
        ProductService $productService,
        \App\Contracts\Repositories\CategoryRepositoryInterface $categoryRepo
    ): void {
        $this->productService = $productService;
        $this->categoryRepo = $categoryRepo;
    }

    public function updatedCategoryId($value)
    {
        if ($value) {
            $category = $this->categoryRepo->findById($value, ['attributes.values']);
            $this->availableAttributes = $category ? $category->attributes : [];
        } else {
            $this->availableAttributes = [];
        }
    }

    public function addSku()
    {
        $this->skus[] = [
            'sku_code' => '',
            'sku_price' => $this->product_price ?? 0,
            'sku_stock' => 0,
            'low_stock_threshold' => 5,
            'attribute_values' => []
        ];
    }

    public function removeSku($index)
    {
        unset($this->skus[$index]);
        $this->skus = array_values($this->skus);
    }

    /**
     * Apply bulk updates to all SKUs in the current form
     */
    public function bulkUpdateSkus(string $type, $value): void
    {
        foreach ($this->skus as $index => $sku) {
            if ($type === 'price') {
                $this->skus[$index]['sku_price'] = (float) $value;
            } elseif ($type === 'stock') {
                $this->skus[$index]['sku_stock'] = (int) $value;
            } elseif ($type === 'price_adjust') {
                // Adjust by percentage (e.g., 1.1 for 10% increase)
                $this->skus[$index]['sku_price'] = round($this->skus[$index]['sku_price'] * (float) $value);
            }
        }
        
        session()->flash('message', 'Bulk update applied to variations.');
    }

    /**
     * Sanitize input before processing
     */
    protected function sanitizeInput(): void
    {
        $this->product_name = strip_tags(trim($this->product_name));
        $this->product_short_description = strip_tags(trim($this->product_short_description));
        $this->product_long_description = strip_tags(trim($this->product_long_description));
        $this->product_shipping_and_return = strip_tags(trim($this->product_shipping_and_return));
        $this->product_vendor = strip_tags(trim($this->product_vendor));
        $this->product_tags = strip_tags(trim($this->product_tags));
    }

    /**
     * Store or update product using ProductService
     */
    public function storeOrUpdateProduct(): mixed
    {
        $this->validate();
        $this->sanitizeInput();

        $data = [
            'category_id' => $this->category_id,
            'product_name' => $this->product_name,
            'product_rating' => $this->product_rating,
            'product_price' => $this->product_price,
            'product_short_description' => $this->product_short_description,
            'product_type' => $this->product_type,
            'product_vendor' => $this->product_vendor,
            'product_availability' => $this->product_availability,
            'product_tags' => $this->product_tags,
            'product_long_description' => $this->product_long_description,
            'product_shipping_and_return' => $this->product_shipping_and_return,
            'product_discount' => $this->product_discount,
            'skus' => $this->skus,
        ];

        // Get image file if uploaded
        $imageFile = $this->product_image instanceof \Livewire\TemporaryUploadedFile
            ? $this->product_image
            : null;

        if ($this->product_id) {
            // Update existing product
            $this->productService->updateProduct($this->product_id, $data, $imageFile);
            session()->flash('message', 'Product updated successfully!');
        } else {
            // Create new product
            $this->productService->createProduct($data, $imageFile);
            session()->flash('message', 'Product created successfully!');
        }

        return to_route('manage-product');
    }

    /**
     * Load product for editing
     */
    public function editProduct(int $productId): void
    {
        $this->product_id = $productId;
        $product = $this->productService->getProduct($productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        $this->title_form = 'Update Product ' . $product->product_name;
        $this->category_id = $product->category_id;
        $this->product_name = $product->product_name;
        $this->product_rating = $product->product_rating;
        $this->product_price = $product->product_price;
        $this->product_short_description = $product->product_short_description;
        $this->product_type = $product->product_type;
        $this->product_vendor = $product->product_vendor;
        $this->product_availability = $product->product_availability;
        $this->product_tags = $product->product_tags;
        $this->product_long_description = $product->product_long_description;
        $this->product_shipping_and_return = $product->product_shipping_and_return;
        $this->product_discount = $product->product_discount;

        // Load SKUs
        $this->skus = $product->skus->map(function($sku) {
            return [
                'sku_code' => $sku->sku_code,
                'sku_price' => $sku->sku_price,
                'sku_stock' => $sku->sku_stock,
                'low_stock_threshold' => $sku->low_stock_threshold,
                'attribute_values' => $sku->attributeValues->pluck('attribute_value_id')->toArray(),
            ];
        })->toArray();

        // Load attributes
        $this->updatedCategoryId($this->category_id);
    }

    /**
     * Reset form to create mode
     */
    public function switchFormToCreate(): void
    {
        $this->reset([
            'product_id',
            'category_id',
            'product_name',
            'product_rating',
            'product_price',
            'product_short_description',
            'product_type',
            'product_vendor',
            'product_availability',
            'product_tags',
            'product_long_description',
            'product_shipping_and_return',
            'product_discount',
            'product_image',
            'skus',
            'availableAttributes'
        ]);
        $this->title_form = 'Create Product';
    }

    /**
     * Delete product using ProductService
     */
    public function deleteProduct(int $productId): mixed
    {
        $this->productService->deleteProduct($productId);
        session()->flash('message', 'Product deleted successfully!');
        return to_route('manage-product');
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('features.admin.manage-product', [
            'products' => $this->productService->getAllProducts(),
            'categories' => $this->categoryRepo->all(),
        ]);
    }
}

