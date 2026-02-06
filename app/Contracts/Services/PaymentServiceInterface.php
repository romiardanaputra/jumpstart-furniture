<?php

namespace App\Contracts\Services;

interface PaymentServiceInterface
{
    /**
     * Process payment with idempotency key
     * 
     * @param array $paymentData Payment details (amount, card info, etc.)
     * @param string $idempotencyKey Unique key to prevent duplicate processing
     * @return array Payment result with status and transaction details
     */
    public function processPayment(array $paymentData, string $idempotencyKey): array;

    /**
     * Calculate total payment including shipping
     * 
     * @param int $userId User ID
     * @param string $shippingMethod Shipping method (exclusive/standard)
     * @return float Total amount to charge
     */
    public function calculateTotal(int $userId, string $shippingMethod): float;

    /**
     * Verify payment status
     * 
     * @param string $transactionId Transaction ID from payment gateway
     * @return array Payment status details
     */
    public function verifyPayment(string $transactionId): array;
}
