<?php

namespace App\Services;

use App\Contracts\Repositories\CartRepositoryInterface;
use App\Contracts\Repositories\CheckoutRepositoryInterface;
use App\Contracts\Services\PaymentServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Exception;

class PaymentService extends BaseService implements PaymentServiceInterface
{
    protected CartRepositoryInterface $cartRepo;
    protected CheckoutRepositoryInterface $checkoutRepo;
    protected \App\Contracts\Services\InventoryServiceInterface $inventoryService;
    protected \App\Contracts\Services\LogisticsServiceInterface $logisticsService;
    protected \App\Services\CartService $cartService; // Added to get weight

    public function __construct(
        CartRepositoryInterface $cartRepo,
        CheckoutRepositoryInterface $checkoutRepo,
        \App\Contracts\Services\InventoryServiceInterface $inventoryService,
        \App\Contracts\Services\LogisticsServiceInterface $logisticsService,
        \App\Services\CartService $cartService
    ) {
        $this->cartRepo = $cartRepo;
        $this->checkoutRepo = $checkoutRepo;
        $this->inventoryService = $inventoryService;
        $this->logisticsService = $logisticsService;
        $this->cartService = $cartService;
    }

    /**
     * Process payment with idempotency protection
     */
    public function processPayment(array $paymentData, string $idempotencyKey): array
    {
        // Check for existing payment with this idempotency key
        $existingCheckout = $this->checkoutRepo->findByIdempotencyKey($idempotencyKey);
        
        if ($existingCheckout) {
            $this->logAction('Idempotent payment detected', [
                'idempotency_key' => $idempotencyKey,
                'checkout_id' => $existingCheckout->id,
            ]);
            
            return [
                'success' => true,
                'message' => 'Payment already processed',
                'checkout' => $existingCheckout,
                'idempotent' => true,
            ];
        }

        // Acquire lock to prevent race conditions
        return Cache::lock("payment_lock_{$idempotencyKey}", 10)->get(function () use ($paymentData, $idempotencyKey) {
            return $this->handleTransaction(function () use ($paymentData, $idempotencyKey) {
                // Initialize Stripe
                Stripe::setApiKey(config('services.stripe.secret'));

                $userId = $paymentData['user_id'];
                $cartItems = $this->cartRepo->getByUserId($userId);

                if ($cartItems->isEmpty()) {
                    throw new Exception('Cart is empty');
                }

                // Create Stripe customer
                $customer = $this->executeWithRetry(function () use ($paymentData) {
                    return Customer::create([
                        'email' => $paymentData['email'],
                        'name' => $paymentData['name'],
                    ]);
                });

                // Create charge with retry
                $charge = $this->executeWithRetry(function () use ($paymentData, $customer) {
                    return Charge::create([
                        'amount' => (int) ($paymentData['amount'] * 100),
                        'currency' => 'usd',
                        'customer' => $customer->id,
                        'source' => 'tok_visa', // In production, use tokenized card
                        'description' => 'JumpStart Furniture Order',
                    ]);
                });

                if (!$charge->paid) {
                    throw new Exception('Payment was not successful');
                }

                // Create checkout records for each cart item
                $checkouts = [];
                foreach ($cartItems as $cartItem) {
                    $checkout = $this->checkoutRepo->createWithIdempotency([
                        'user_id' => $userId,
                        'product_id' => $cartItem->product_id,
                        'sku_id' => $cartItem->sku_id,
                        'cart_id' => $cartItem->cart_id,
                        'shipping_address' => $paymentData['shipping_address'],
                        'shipping_price' => $paymentData['shipping_price'],
                        'shipping_method' => $paymentData['shipping_method'],
                        'payment_status' => 'paid',
                        'payment_total_per_item' => $cartItem->total_price,
                        'stripe_charge_id' => $charge->id,
                    ], $idempotencyKey . '_' . $cartItem->cart_id);
                    
                    $checkouts[] = $checkout;

                    // Deduct stock
                    if ($cartItem->sku_id) {
                        $this->inventoryService->deductStock($cartItem->sku_id, 1);
                    }
                }

                // Clear cart after successful payment
                $this->cartRepo->clearByUserId($userId);

                $this->logAction('Payment processed successfully', [
                    'user_id' => $userId,
                    'amount' => $paymentData['amount'],
                    'stripe_charge_id' => $charge->id,
                ]);

                return [
                    'success' => true,
                    'message' => 'Payment successful',
                    'checkouts' => $checkouts,
                    'stripe_charge_id' => $charge->id,
                ];
            });
        });
    }

    /**
     * Calculate total payment including shipping
     */
    public function calculateTotal(int $userId, string $shippingMethod, string $destination = 'Jakarta'): float
    {
        $cartTotal = $this->cartRepo->getTotalByUserId($userId);
        $cartWeight = $this->cartService->getCartWeight($userId);
        
        $shippingPrice = $this->logisticsService->calculateShippingRate(
            $destination,
            $cartWeight,
            $shippingMethod
        );

        return $cartTotal + $shippingPrice;
    }

    /**
     * Get shipping price (legacy/helper)
     */
    protected function getShippingPrice(string $shippingMethod): float
    {
        return 20000; // Fixed flat default
    }

    /**
     * Verify payment status from Stripe
     */
    public function verifyPayment(string $transactionId): array
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = $this->executeWithRetry(function () use ($transactionId) {
                return Charge::retrieve($transactionId);
            });

            return [
                'success' => true,
                'paid' => $charge->paid,
                'status' => $charge->status,
                'amount' => $charge->amount / 100,
            ];
        } catch (Exception $e) {
            Log::error('Payment verification failed', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
