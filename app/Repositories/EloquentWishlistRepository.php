<?php

namespace App\Repositories;

use App\Contracts\Repositories\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentWishlistRepository implements WishlistRepositoryInterface
{
    public function toggle(int $userId, int $productId): bool
    {
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return false;
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return true;
    }

    public function getByUser(int $userId): Collection
    {
        return Wishlist::where('user_id', $userId)
            ->with(['product' => function($query) {
                $query->withAvg('reviews', 'rating')->withCount('reviews');
            }])
            ->latest()
            ->get();
    }

    public function isWishlisted(int $userId, int $productId): bool
    {
        return Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }

    public function getPopularProducts(int $limit = 10): Collection
    {
        return Wishlist::select('product_id', DB::raw('count(*) as wishlist_count'))
            ->groupBy('product_id')
            ->orderByDesc('wishlist_count')
            ->with(['product' => function($query) {
                $query->select('product_id', 'product_name', 'product_price', 'product_image');
            }])
            ->limit($limit)
            ->get();
    }
}
