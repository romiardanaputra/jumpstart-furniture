<?php

namespace App\Services;

use App\Contracts\Repositories\CartRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\SkuRepositoryInterface;
use App\Events\CartUpdated;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartService extends BaseService
{
    protected CartRepositoryInterface $cartRepo;
    protected ProductRepositoryInterface $productRepo;
    protected SkuRepositoryInterface $skuRepo;

    public function __construct(
        CartRepositoryInterface $cartRepo,
        ProductRepositoryInterface $productRepo,
        SkuRepositoryInterface $skuRepo
    ) {
        $this->cartRepo = $cartRepo;
        $this->productRepo = $productRepo;
        $this->skuRepo = $skuRepo;
    }

    /**
     * Get user's cart items
     */
    public function getCartItems(int $userId): Collection
    {
        return $this->cartRepo->getByUserId($userId);
    }

    /**
     * Get cart total
     */
    public function getCartTotal(int $userId): float
    {
        return $this->cartRepo->getTotalByUserId($userId);
    }

    /**
     * Add item to cart
     */
    public function addToCart(int $userId, int $productId, int $skuId, int $quantity = 1): Model
    {
        return $this->handleTransaction(function () use ($userId, $productId, $skuId, $quantity) {
            $sku = $this->skuRepo->findById($skuId);

            if (!$sku || $sku->product_id !== $productId) {
                throw new \Exception('Invalid SKU or variation for this product');
            }

            $price = $sku->sku_price;
            $product = $sku->product;

            // Apply discount if exists on parent product
            if ($product->product_discount > 0) {
                $price = $price * (1 - ($product->product_discount / 100));
            }

            $cartItem = $this->cartRepo->addItem($userId, $productId, $skuId, $quantity, $price);

            event(new CartUpdated($cartItem));

            $this->logAction('Item added to cart', [
                'user_id' => $userId,
                'product_id' => $productId,
                'sku_id' => $skuId,
                'quantity' => $quantity,
            ]);

            return $cartItem;
        });
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(int $cartId, int $quantity): bool
    {
        return $this->handleTransaction(function () use ($cartId, $quantity) {
            $updated = $this->cartRepo->updateQuantity($cartId, $quantity);

            $cart = $this->cartRepo->findById($cartId);
            if ($cart) {
                event(new CartUpdated($cart));
            }

            $this->logAction('Cart quantity updated', [
                'cart_id' => $cartId,
                'quantity' => $quantity,
            ]);

            return $updated;
        });
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(int $cartId): bool
    {
        return $this->handleTransaction(function () use ($cartId) {
            $removed = $this->cartRepo->removeItem($cartId);

            $this->logAction('Item removed from cart', [
                'cart_id' => $cartId,
            ]);

            return $removed;
        });
    }

    /**
     * Clear user's cart
     */
    public function clearCart(int $userId): bool
    {
        return $this->handleTransaction(function () use ($userId) {
            $cleared = $this->cartRepo->clearByUserId($userId);

            $this->logAction('Cart cleared', [
                'user_id' => $userId,
            ]);

            return $cleared;
        });
    }

    /**
     * Calculate cart summary with shipping
     */
    public function getCartSummary(int $userId, string $shippingMethod = 'standard'): array
    {
        $cartItems = $this->cartRepo->getByUserId($userId);
        $subtotal = $cartItems->sum('total_price');
        
        $shippingCosts = [
            'standard' => 10.00,
            'express' => 25.00,
            'overnight' => 50.00,
        ];
        
        $shipping = $shippingCosts[$shippingMethod] ?? $shippingCosts['standard'];
        
        return [
            'items' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ];
    }

    /**
     * Increment quantity for cart item
     */
    public function incrementQuantity(int $cartId, int $productId): bool
    {
        $cart = $this->cartRepo->findById($cartId, ['sku']);
        
        if (!$cart || $cart->quantity >= 10 || !$cart->sku) {
            return false;
        }
        
        $sku = $cart->sku;
        $price = $sku->sku_price;
        
        // Apply discount if exists on parent product
        if ($sku->product->product_discount > 0) {
            $price = $price * (1 - ($sku->product->product_discount / 100));
        }

        $newQuantity = $cart->quantity + 1;
        
        return $this->cartRepo->update($cartId, [
            'quantity' => $newQuantity,
            'total_price' => $newQuantity * $price,
        ]);
    }

    /**
     * Decrement quantity for cart item
     */
    public function decrementQuantity(int $cartId, int $productId): bool
    {
        $cart = $this->cartRepo->findById($cartId, ['sku']);
        
        if (!$cart || $cart->quantity <= 1 || !$cart->sku) {
            return false;
        }
        
        $sku = $cart->sku;
        $price = $sku->sku_price;
        
        // Apply discount if exists on parent product
        if ($sku->product->product_discount > 0) {
            $price = $price * (1 - ($sku->product->product_discount / 100));
        }

        $newQuantity = $cart->quantity - 1;
        
        return $this->cartRepo->update($cartId, [
            'quantity' => $newQuantity,
            'total_price' => $newQuantity * $price,
        ]);
    }

    /**
     * Add special instruction to all cart items for user
     */
    public function addSpecialInstruction(int $userId, string $instruction): bool
    {
        $carts = $this->cartRepo->getByUserId($userId);
        
        foreach ($carts as $cart) {
            $this->cartRepo->update($cart->cart_id, [
                'special_instruction' => $instruction,
            ]);
        }
        
        return true;
    }

    /**
     * Get shipping price based on method
     */
    protected function getShippingPrice(string $shippingMethod): float
    {
        return match ($shippingMethod) {
            'exclusive' => 40.00,
            'standard' => 20.00,
            default => 20.00,
        };
    }
}
