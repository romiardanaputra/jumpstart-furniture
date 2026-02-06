<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all products with eager loaded relations
     */
    public function allWithRelations(): Collection
    {
        return $this->model->with(['user', 'cart'])->get();
    }

    /**
     * Find products by type
     */
    public function findByType(string $type): Collection
    {
        return $this->model
            ->where('product_type', $type)
            ->with(['user'])
            ->get();
    }

    /**
     * Find products by vendor
     */
    public function findByVendor(string $vendor): Collection
    {
        return $this->model
            ->where('product_vendor', $vendor)
            ->with(['user'])
            ->get();
    }

    /**
     * Find available products
     */
    public function findAvailable(): Collection
    {
        return $this->model
            ->where('product_availability', true)
            ->with(['user'])
            ->get();
    }

    /**
     * Search products by name or tags
     */
    public function search(string $query): Collection
    {
        return $this->model
            ->where('product_name', 'LIKE', "%{$query}%")
            ->orWhere('product_tags', 'LIKE', "%{$query}%")
            ->with(['user'])
            ->get();
    }
}
