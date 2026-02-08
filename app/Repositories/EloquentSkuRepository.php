<?php

namespace App\Repositories;

use App\Models\Sku;
use App\Contracts\Repositories\SkuRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentSkuRepository extends BaseRepository implements SkuRepositoryInterface
{
    public function __construct(Sku $model)
    {
        parent::__construct($model);
    }

    /**
     * Find SKU by code
     */
    public function findByCode(string $code): ?Sku
    {
        return $this->model->where('sku_code', $code)->first();
    }

    /**
     * Find SKUs by product ID
     */
    public function getByProductId(int $productId): Collection
    {
        return $this->model->where('product_id', $productId)->get();
    }

    /**
     * Check if SKU has sufficient stock
     */
    public function hasStock(int $skuId, int $quantity): bool
    {
        $sku = $this->findById($skuId);
        return $sku && $sku->sku_stock >= $quantity;
    }

    /**
     * Decrease SKU stock
     */
    public function decreaseStock(int $skuId, int $quantity): bool
    {
        return $this->model->where('sku_id', $skuId)
            ->where('sku_stock', '>=', $quantity)
            ->decrement('sku_stock', $quantity) > 0;
    }
}
