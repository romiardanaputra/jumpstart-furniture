<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface ProductServiceInterface
{
    /**
     * Get all products with caching
     */
    public function getAllProducts(): Collection;

    /**
     * Get products by type with caching
     */
    public function getProductsByType(string $type): Collection;

    /**
     * Get available products
     */
    public function getAvailableProducts(): Collection;

    /**
     * Search products
     */
    public function searchProducts(string $query): Collection;

    /**
     * Get single product by ID
     */
    public function getProduct(int $productId): ?Model;

    /**
     * Create new product
     */
    public function createProduct(array $data, ?UploadedFile $image = null): Model;

    /**
     * Update existing product
     */
    public function updateProduct(int $productId, array $data, ?UploadedFile $image = null): bool;

    /**
     * Delete product
     */
    public function deleteProduct(int $productId): bool;
}
