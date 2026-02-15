<?php

namespace App\Http\Livewire;

use App\Services\CartService;
use Livewire\Component;

class ShoppingCart extends Component
{
    public ?int $cart_id = null;
    public float $total_payment = 0;
    public float $subtotal_payment = 0;
    public float $discount_amount = 0;
    public string $special_instruction = '';
    public string $coupon_code = '';
    public ?string $coupon_message = null;
    public bool $is_coupon_valid = false;
    
    protected CartService $cartService;
    protected \App\Contracts\Services\CouponServiceInterface $couponService;

    /**
     * Boot method for dependency injection
     */
    public function boot(CartService $cartService, \App\Contracts\Services\CouponServiceInterface $couponService): void
    {
        $this->cartService = $cartService;
        $this->couponService = $couponService;
    }

    public function mount(): void
    {
        $this->calculateSubtotal();
    }

    /**
     * Increment item quantity
     */
    public function incrementQuantity(int $cartId, int $productId): void
    {
        $this->cartService->incrementQuantity($cartId, $productId);
        $this->calculateSubtotal();
    }

    /**
     * Decrement item quantity
     */
    public function decrementQuantity(int $cartId, int $productId): void
    {
        $this->cartService->decrementQuantity($cartId, $productId);
        $this->calculateSubtotal();
    }

    /**
     * Calculate subtotal from cart items
     */
    public function calculateSubtotal(): void
    {
        $this->subtotal_payment = $this->cartService->getCartTotal(
            auth()->user()->id
        );

        // Re-validate and apply discount if a coupon was previously applied
        if (session()->has('applied_coupon')) {
            $this->coupon_code = session('applied_coupon');
            $this->applyCoupon();
        } else {
            $this->total_payment = $this->subtotal_payment;
        }
    }

    /**
     * Apply coupon code to cart
     */
    public function applyCoupon(): void
    {
        if (empty($this->coupon_code)) {
            $this->resetCoupon();
            return;
        }

        $result = $this->couponService->validateCoupon(
            $this->coupon_code,
            auth()->id(),
            $this->subtotal_payment
        );

        if ($result['valid']) {
            $coupon = $result['coupon'];
            $this->discount_amount = $coupon->calculateDiscount($this->subtotal_payment);
            $this->total_payment = $this->subtotal_payment - $this->discount_amount;
            $this->is_coupon_valid = true;
            $this->coupon_message = $result['message'];
            session(['applied_coupon' => $this->coupon_code]);
        } else {
            $this->resetCoupon();
            $this->coupon_message = $result['message'];
        }
    }

    /**
     * Reset coupon state
     */
    public function resetCoupon(): void
    {
        $this->discount_amount = 0;
        $this->total_payment = $this->subtotal_payment;
        $this->is_coupon_valid = false;
        $this->coupon_message = null;
        session()->forget('applied_coupon');
    }

    /**
     * Add special instruction to cart items
     */
    public function addSpecialInstruction(): mixed
    {
        // Sanitize input
        $sanitizedInstruction = strip_tags(trim($this->special_instruction));
        
        $this->cartService->addSpecialInstruction(
            auth()->user()->id,
            $sanitizedInstruction
        );

        session()->flash('message', 'Special instructions added successfully!');
        return to_route('info-status');
    }

    /**
     * Delete cart item
     */
    public function deleteCart(int $cartId): mixed
    {
        $this->cartService->removeFromCart($cartId);
        session()->flash('message', 'Item removed from cart!');
        return to_route('shopping-cart');
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('features.shop.shopping-cart', [
            'carts' => $this->cartService->getCartItems(auth()->user()->id),
        ])->layout('layouts.app-user');
    }
}

