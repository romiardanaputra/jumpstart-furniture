<?php

namespace App\Repositories;

use App\Models\Review;
use App\Contracts\Repositories\ReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function getByProductId(int $productId): Collection
    {
        return $this->model
            ->where('product_id', $productId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAverageRating(int $productId): float
    {
        return (float) ($this->model
            ->where('product_id', $productId)
            ->avg('rating') ?? 0);
    }
}
