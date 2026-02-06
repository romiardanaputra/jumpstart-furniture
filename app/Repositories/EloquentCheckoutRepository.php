<?php

namespace App\Repositories;

use App\Models\Checkout;
use App\Contracts\Repositories\CheckoutRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentCheckoutRepository extends BaseRepository implements CheckoutRepositoryInterface
{
    public function __construct(Checkout $model)
    {
        parent::__construct($model);
    }

    /**
     * Get checkouts by user ID
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Find checkout by idempotency key
     */
    public function findByIdempotencyKey(string $key): ?Checkout
    {
        return $this->model
            ->where('idempotency_key', $key)
            ->first();
    }

    /**
     * Create checkout with idempotency check
     */
    public function createWithIdempotency(array $data, string $idempotencyKey): Checkout
    {
        // Check if checkout with this key already exists
        $existing = $this->findByIdempotencyKey($idempotencyKey);
        
        if ($existing) {
            return $existing;
        }

        return $this->model->create(array_merge($data, [
            'idempotency_key' => $idempotencyKey,
        ]));
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(int $checkoutId, string $status): bool
    {
        return $this->update($checkoutId, [
            'payment_status' => $status,
        ]);
    }

    /**
     * Get pending checkouts
     */
    public function getPending(): Collection
    {
        return $this->model
            ->where('payment_status', 'pending')
            ->with(['product', 'user'])
            ->get();
    }
}
