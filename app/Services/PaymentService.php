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
    protected \App\Services\CartService $cartService;
    protected \App\Contracts\Services\XenditServiceInterface $xenditService;

    public function __construct(
        CartRepositoryInterface $cartRepo,
        CheckoutRepositoryInterface $checkoutRepo,
        \App\Contracts\Services\InventoryServiceInterface $inventoryService,
        \App\Contracts\Services\LogisticsServiceInterface $logisticsService,
        \App\Services\CartService $cartService,
        \App\Contracts\Services\XenditServiceInterface $xenditService
    ) {
        $this->cartRepo = $cartRepo;
        $this->checkoutRepo = $checkoutRepo;
        $this->inventoryService = $inventoryService;
        $this->logisticsService = $logisticsService;
        $this->cartService = $cartService;
        $this->xenditService = $xenditService;
    }

    /**
     * Process payment with Xendit Invoice
     */
    public function processPayment(array $paymentData, string $idempotencyKey): array
    {
        // Check for existing payment with this idempotency key
        $existingCheckout = $this->checkoutRepo->findByIdempotencyKey($idempotencyKey);
        
        if ($existingCheckout) {
            return [
                'success' => true,
                'message' => 'Payment already initiated',
                'checkout' => $existingCheckout,
                'invoice_url' => $existingCheckout->xendit_invoice_url ?? '#',
            ];
        }

        return $this->handleTransaction(function () use ($paymentData, $idempotencyKey) {
            $userId = $paymentData['user_id'];
            $cartItems = $this->cartRepo->getByUserId($userId);

            if ($cartItems->isEmpty()) {
                throw new Exception('Cart is empty');
            }

            // Prepare item list for Xendit
            $items = [];
            foreach ($cartItems as $cartItem) {
                // Determine item display name (including variation)
                $variationName = '';
                if ($cartItem->sku && $cartItem->sku->attributeValues) {
                    $variationName = ' (' . $cartItem->sku->attributeValues->pluck('value')->implode(', ') . ')';
                }

                $items[] = [
                    'name' => $cartItem->product->product_name . $variationName,
                    'quantity' => 1,
                    'price' => (float) $cartItem->total_price,
                ];
            }

            // Add shipping as an item if exists
            if (isset($paymentData['shipping_price']) && $paymentData['shipping_price'] > 0) {
                $items[] = [
                    'name' => 'Shipping (' . ($paymentData['shipping_method'] ?? 'Standard') . ')',
                    'quantity' => 1,
                    'price' => (float) $paymentData['shipping_price'],
                ];
            }

            // Generate Xendit Invoice
            $externalId = 'INV-' . $userId . '-' . time();
            $invoice = $this->xenditService->createInvoice([
                'external_id' => $externalId,
                'amount' => (float) $paymentData['amount'],
                'payer_email' => $paymentData['email'],
                'description' => 'JumpStart Furniture Order - ' . $paymentData['name'],
                'items' => $items,
            ]);

            // Create checkout records (status: pending)
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
                    'payment_status' => 'pending', // Set to pending for Xendit
                    'payment_total' => $cartItem->total_price,
                    'xendit_invoice_id' => $invoice['invoice_id'],
                    'xendit_external_id' => $externalId,
                ], $idempotencyKey . '_' . $cartItem->cart_id);
                
                $checkouts[] = $checkout;

                // Lock stock (don't deduct yet, wait for payment callback)
                // In production, we might want to temporarily reservate stock
            }

            $this->logAction('Xendit payment initiated', [
                'user_id' => $userId,
                'amount' => $paymentData['amount'],
                'invoice_id' => $invoice['invoice_id'],
            ]);

            return [
                'success' => true,
                'message' => 'Invoice created',
                'invoice_url' => $invoice['invoice_url'],
                'invoice_id' => $invoice['invoice_id'],
                'checkouts' => $checkouts,
            ];
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
