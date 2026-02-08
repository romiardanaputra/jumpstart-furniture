<?php

namespace App\Services;

use App\Contracts\Repositories\WishlistRepositoryInterface;
use App\Contracts\Services\WishlistServiceInterface;
use Illuminate\Support\Collection;

class WishlistService implements WishlistServiceInterface
{
    protected $wishlistRepository;

    public function __construct(WishlistRepositoryInterface $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function toggleWishlist(int $userId, int $productId): bool
    {
        return $this->wishlistRepository->toggle($userId, $productId);
    }

    public function getUserWishlist(int $userId): Collection
    {
        return $this->wishlistRepository->getByUser($userId);
    }

    public function getWishlistAnalytics(int $limit = 10): Collection
    {
        return $this->wishlistRepository->getPopularProducts($limit);
    }

    public function isWishlisted(?int $userId, int $productId): bool
    {
        if (!$userId) {
            return false;
        }

        return $this->wishlistRepository->isWishlisted($userId, $productId);
    }
}
