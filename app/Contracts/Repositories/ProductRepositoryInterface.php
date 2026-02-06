<?php

namespace App\Contracts\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all products with eager loaded relations
     */
    public function allWithRelations(): Collection;

    /**
     * Find products by type
     */
    public function findByType(string $type): Collection;

    /**
     * Find products by vendor
     */
    public function findByVendor(string $vendor): Collection;

    /**
     * Find available products
     */
    public function findAvailable(): Collection;

    /**
     * Search products by name or tags
     */
    public function search(string $query): Collection;
}
