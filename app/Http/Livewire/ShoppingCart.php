<?php

namespace App\Http\Livewire;

use App\Services\CartService;
use Livewire\Component;

class ShoppingCart extends Component
{
    public ?int $cart_id = null;
    public float $total_payment = 0;
    public float $subtotal_payment = 0;
    public string $special_instruction = '';
    
    protected CartService $cartService;

    /**
     * Boot method for dependency injection
     */
    public function boot(CartService $cartService): void
    {
        $this->cartService = $cartService;
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
        ]);
    }
}

