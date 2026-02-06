<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CartServiceInterface
{
    /**
     * Get user's cart items
     */
    public function getCartItems(int $userId): Collection;

    /**
     * Get cart total
     */
    public function getCartTotal(int $userId): float;

    /**
     * Add item to cart
     */
    public function addToCart(int $userId, int $productId, int $quantity = 1): Model;

    /**
     * Update cart item quantity
     */
    public function updateQuantity(int $cartId, int $quantity): bool;

    /**
     * Remove item from cart
     */
    public function removeFromCart(int $cartId): bool;

    /**
     * Clear user's cart
     */
    public function clearCart(int $userId): bool;

    /**
     * Calculate cart summary with shipping
     */
    public function getCartSummary(int $userId, string $shippingMethod = 'standard'): array;
}
