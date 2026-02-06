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
     * Delete product
     */
    public function deleteProduct(int $productId): bool
    {
        return $this->handleTransaction(function () use ($productId) {
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
