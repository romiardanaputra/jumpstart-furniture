<?php

namespace App\Contracts\Repositories;

use App\Models\Sku;
use Illuminate\Database\Eloquent\Collection;

interface SkuRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find SKU by code
     */
    public function findByCode(string $code): ?Sku;

    /**
     * Find SKUs by product ID
     */
    public function getByProductId(int $productId): Collection;

    /**
     * Check if SKU has sufficient stock
     */
    public function hasStock(int $skuId, int $quantity): bool;

    /**
     * Decrease SKU stock
     */
    public function decreaseStock(int $skuId, int $quantity): bool;
}
