<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface WishlistServiceInterface
{
    public function toggleWishlist(int $userId, int $productId): bool;
    public function getUserWishlist(int $userId): Collection;
    public function isWishlisted(int $userId, int $productId): bool;
    public function getWishlistAnalytics(int $limit = 5): Collection;
}
