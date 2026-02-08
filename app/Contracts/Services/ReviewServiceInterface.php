<?php

namespace App\Contracts\Services;

interface ReviewServiceInterface
{
    /**
     * Store a new product review
     */
    public function storeReview(array $data): \App\Models\Review;

    /**
     * Check if user has purchased the product (Verified Purchase)
     */
    public function isVerifiedPurchase(int $userId, int $productId): bool;

    /**
     * Process and optimize uploaded review images
     */
    public function processReviewImages(array $images): array;
}
