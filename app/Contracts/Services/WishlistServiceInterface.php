<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface WishlistServiceInterface
{
    /**
     * Toggle a product in user's wishlist
     *
     * @param int $userId
     * @param int $productId
     * @return bool True if added, false if removed
     */
    public function toggleWishlist(int $userId, int $productId): bool;

    /**
     * Get wishlist items for a user
     *
     * @param int $userId
     * @return Collection
     */
    public function getUserWishlist(int $userId): Collection;

    /**
     * Get most wishlisted products for analytics
     *
     * @param int $limit
     * @return Collection
     */
    public function getWishlistAnalytics(int $limit = 10): Collection;

    /**
     * Check if product is wishlisted by user
     *
     * @param int|null $userId
     * @param int $productId
     * @return bool
     */
    public function isWishlisted(?int $userId, int $productId): bool;
}
