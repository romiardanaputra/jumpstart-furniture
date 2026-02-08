<?php

namespace App\Contracts\Services;

interface InventoryServiceInterface
{
    /**
     * Check if item is available in requested quantity
     */
    public function checkAvailability(int $skuId, int $quantity): bool;

    /**
     * Deduct stock atomically
     * Returns true if successful
     */
    public function deductStock(int $skuId, int $quantity): bool;

    /**
     * Replenish stock atomically
     */
    public function replenishStock(int $skuId, int $quantity): bool;

    /**
     * Get current stock level
     */
    public function getStockLevel(int $skuId): int;
}
