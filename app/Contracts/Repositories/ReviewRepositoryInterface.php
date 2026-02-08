<?php

namespace App\Contracts\Repositories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get reviews for a specific product
     */
    public function getByProductId(int $productId): Collection;

    /**
     * Get average rating for a specific product
     */
    public function getAverageRating(int $productId): float;
}
