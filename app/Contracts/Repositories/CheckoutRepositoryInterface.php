<?php

namespace App\Contracts\Repositories;

use App\Models\Checkout;
use Illuminate\Database\Eloquent\Collection;

interface CheckoutRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get checkouts by user ID
     */
    public function getByUserId(int $userId): Collection;

    /**
     * Find checkout by idempotency key
     */
    public function findByIdempotencyKey(string $key): ?Checkout;

    /**
     * Create checkout with idempotency check
     */
    public function createWithIdempotency(array $data, string $idempotencyKey): Checkout;

    /**
     * Update payment status
     */
    public function updatePaymentStatus(int $checkoutId, string $status): bool;

    /**
     * Get pending checkouts
     */
    public function getPending(): Collection;
}
