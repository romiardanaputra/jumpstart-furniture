<?php

namespace App\Contracts\Repositories;

use App\Models\Wishlist;
use Illuminate\Support\Collection;

interface WishlistRepositoryInterface
{
    /**
     * Toggle a product in user's wishlist
     *
     * @param int $userId
     * @param int $productId
     * @return bool True if added, false if removed
     */
    public function toggle(int $userId, int $productId): bool;

    /**
     * Get all wishlist items for a user
     *
     * @param int $userId
     * @return Collection
     */
    public function getByUser(int $userId): Collection;

    /**
     * Check if a product is in user's wishlist
     *
     * @param int $userId
     * @param int $productId
     * @return bool
     */
    public function isWishlisted(int $userId, int $productId): bool;

    /**
     * Get popularity analytics for products
     *
     * @param int $limit
     * @return Collection
     */
    public function getPopularProducts(int $limit = 10): Collection;
}
