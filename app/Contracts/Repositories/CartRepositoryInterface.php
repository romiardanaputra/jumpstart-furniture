<?php

namespace App\Contracts\Repositories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get cart items by user ID with product relations
     */
    public function getByUserId(int $userId): Collection;

    /**
     * Get cart total for user
     */
    public function getTotalByUserId(int $userId): float;

    /**
     * Add item to cart
     */
    public function addItem(int $userId, int $productId, int $quantity, float $price): Cart;

    /**
     * Update cart item quantity
     */
    public function updateQuantity(int $cartId, int $quantity): bool;

    /**
     * Remove item from cart
     */
    public function removeItem(int $cartId): bool;

    /**
     * Clear user's cart
     */
    public function clearByUserId(int $userId): bool;
}
