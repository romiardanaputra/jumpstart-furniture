<?php

namespace App\Services;

use App\Contracts\Repositories\ReviewRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Services\ReviewServiceInterface;
use App\Models\Review;
use App\Models\Checkout;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ReviewService extends BaseService implements ReviewServiceInterface
{
    protected ReviewRepositoryInterface $reviewRepo;
    protected ProductRepositoryInterface $productRepo;

    public function __construct(
        ReviewRepositoryInterface $reviewRepo,
        ProductRepositoryInterface $productRepo
    ) {
        $this->reviewRepo = $reviewRepo;
        $this->productRepo = $productRepo;
    }

    public function storeReview(array $data): Review
    {
        return $this->handleTransaction(function () use ($data) {
            $isVerified = $this->isVerifiedPurchase($data['user_id'], $data['product_id']);
            
            $reviewData = array_merge($data, [
                'is_verified' => $isVerified,
            ]);

            return $this->reviewRepo->create($reviewData);
        });
    }

    public function isVerifiedPurchase(int $userId, int $productId): bool
    {
        return Checkout::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('payment_status', 'paid')
            ->exists();
    }

    public function processReviewImages(array $images): array
    {
        $processedPaths = [];

        foreach ($images as $image) {
            $filename = Str::random(40) . '.webp';
            $path = 'reviews/' . $filename;

            // Use Intervention Image to optimize
            $img = Image::make($image->getRealPath());
            
            // Resize to max 1200px width or height while maintaining aspect ratio
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upSize();
            })->encode('webp', 80); // Encode as WebP with 80 quality

            Storage::disk('public')->put($path, $img->stream());
            $processedPaths[] = $path;
        }

        return $processedPaths;
    }
}
