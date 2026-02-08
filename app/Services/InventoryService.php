<?php

namespace App\Services;

use App\Contracts\Services\InventoryServiceInterface;
use App\Contracts\Repositories\SkuRepositoryInterface;
use App\Events\LowStockDetected;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryService extends BaseService implements InventoryServiceInterface
{
    protected SkuRepositoryInterface $skuRepo;

    public function __construct(SkuRepositoryInterface $skuRepo)
    {
        $this->skuRepo = $skuRepo;
    }

    /**
     * Check if item is available
     */
    public function checkAvailability(int $skuId, int $quantity): bool
    {
        return $this->skuRepo->hasStock($skuId, $quantity);
    }

    /**
     * Deduct stock atomically
     */
    public function deductStock(int $skuId, int $quantity): bool
    {
        return $this->handleTransaction(function () use ($skuId, $quantity) {
            $success = $this->skuRepo->decreaseStock($skuId, $quantity);

            if ($success) {
                $this->checkLowStock($skuId);
            }

            return $success;
        });
    }

    /**
     * Replenish stock atomically
     */
    public function replenishStock(int $skuId, int $quantity): bool
    {
        return $this->handleTransaction(function () use ($skuId, $quantity) {
            $sku = $this->skuRepo->findById($skuId);
            if (!$sku) return false;

            return $sku->increment('sku_stock', $quantity);
        });
    }

    /**
     * Get current stock level
     */
    public function getStockLevel(int $skuId): int
    {
        $sku = $this->skuRepo->findById($skuId);
        return $sku ? $sku->sku_stock : 0;
    }

    /**
     * Internal check for low stock
     */
    protected function checkLowStock(int $skuId): void
    {
        $sku = $this->skuRepo->findById($skuId);
        
        if ($sku && $sku->sku_stock <= $sku->low_stock_threshold) {
            event(new LowStockDetected($sku));
            
            Log::warning("Low stock detected for SKU: {$sku->sku_code}", [
                'sku_id' => $skuId,
                'current_stock' => $sku->sku_stock,
                'threshold' => $sku->low_stock_threshold
            ]);
        }
    }
}
