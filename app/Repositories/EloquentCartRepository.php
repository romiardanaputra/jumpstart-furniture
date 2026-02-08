<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Contracts\Repositories\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentCartRepository extends BaseRepository implements CartRepositoryInterface
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    /**
     * Get cart items by user ID with product relations
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->with(['product', 'sku.attributeValues.attribute', 'user'])
            ->get();
    }

    /**
     * Get cart total for user
     */
    public function getTotalByUserId(int $userId): float
    {
        return (float) $this->model
            ->where('user_id', $userId)
            ->sum('total_price');
    }

    /**
     * Add item to cart
     */
    public function addItem(int $userId, int $productId, int $skuId, int $quantity, float $price): Cart
    {
        return $this->model->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'sku_id' => $skuId,
            'quantity' => $quantity,
            'total_price' => $price * $quantity,
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(int $cartId, int $quantity): bool
    {
        $cart = $this->model->find($cartId);
        
        if (!$cart) {
            return false;
        }

        $pricePerItem = $cart->total_price / max($cart->quantity, 1);
        
        return $cart->update([
            'quantity' => $quantity,
            'total_price' => $pricePerItem * $quantity,
        ]);
    }

    /**
     * Remove item from cart
     */
    public function removeItem(int $cartId): bool
    {
        return $this->delete($cartId);
    }

    /**
     * Clear user's cart
     */
    public function clearByUserId(int $userId): bool
    {
        return $this->model
            ->where('user_id', $userId)
            ->delete() > 0;
    }
}
