<?php

namespace App\Services;

use App\Contracts\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\UploadedFile;

class ProductService extends BaseService
{
    protected ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Get all products with caching
     */
    public function getAllProducts(): Collection
    {
        return Cache::remember('products.all', 3600, function () {
            return $this->productRepo->allWithRelations();
        });
    }

    /**
     * Get products by type with caching
     */
    public function getProductsByType(string $type): Collection
    {
        return Cache::remember("products.type.{$type}", 3600, function () use ($type) {
            return $this->productRepo->findByType($type);
        });
    }

    /**
     * Get available products
     */
    public function getAvailableProducts(): Collection
    {
        return Cache::remember('products.available', 3600, function () {
            return $this->productRepo->findAvailable();
        });
    }

    /**
     * Search products
     */
    public function searchProducts(string $query): Collection
    {
        return $this->productRepo->search($query);
    }

    /**
     * Get single product by ID
     */
    public function getProduct(int $productId): ?Model
    {
        return $this->productRepo->findById($productId, ['user', 'cart']);
    }

    /**
     * Create new product
     */
    public function createProduct(array $data, ?UploadedFile $image = null): Model
    {
        return $this->handleTransaction(function () use ($data, $image) {
            if ($image) {
                $data['product_image'] = $image->store('product_image', 'public');
            }

            $data['user_id'] = auth()->id();

            $product = $this->productRepo->create($data);

            if (isset($data['skus'])) {
                $this->syncSkus($product->product_id, $data['skus']);
            }

            $this->clearProductCache();

            $this->logAction('Product created', [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
            ]);

            return $product;
        });
    }

    /**
     * Update existing product
     */
    public function updateProduct(int $productId, array $data, ?UploadedFile $image = null): bool
    {
        return $this->handleTransaction(function () use ($productId, $data, $image) {
            if ($image) {
                $data['product_image'] = $image->store('product_image', 'public');
            }

            $updated = $this->productRepo->update($productId, $data);

            if (isset($data['skus'])) {
                $this->syncSkus($productId, $data['skus']);
            }

            if ($updated) {
                $this->clearProductCache();

                $this->logAction('Product updated', [
                    'product_id' => $productId,
                ]);
            }

            return $updated;
        });
    }

    /**
     * Synchronize SKUs and their attributes for a product
     */
    public function syncSkus(int $productId, array $skusData): void
    {
        $product = $this->productRepo->findById($productId);
        if (!$product) return;

        // Simplified sync for demo: Delete existing if we want total overwrite
        // In production, we would diff by SKU code
        $product->skus()->delete();

        foreach ($skusData as $skuData) {
            $sku = $product->skus()->create([
                'sku_code' => $skuData['sku_code'],
                'sku_price' => $skuData['sku_price'],
                'sku_stock' => $skuData['sku_stock'],
                'low_stock_threshold' => $skuData['low_stock_threshold'] ?? 5,
                'sku_weight' => $skuData['sku_weight'] ?? 0,
                'sku_dimensions' => $skuData['sku_dimensions'] ?? [],
            ]);

            if (isset($skuData['attribute_values'])) {
                $sku->attributeValues()->sync($skuData['attribute_values']);
            }
        }
    }

    /**
     * Delete product
     */
    public function deleteProduct(int $productId): bool
    {
        return $this->handleTransaction(function () use ($productId) {
            $product = $this->productRepo->findById($productId);
            if ($product) {
                $product->skus()->delete(); // Clean up SKUs
            }
            
            $deleted = $this->productRepo->delete($productId);

            if ($deleted) {
                $this->clearProductCache();

                $this->logAction('Product deleted', [
                    'product_id' => $productId,
                ]);
            }

            return $deleted;
        });
    }

    /**
     * Clear product-related cache
     */
    protected function clearProductCache(): void
    {
        Cache::forget('products.all');
        Cache::forget('products.available');
        // Clear type caches would need pattern matching - simplified here
    }
}
