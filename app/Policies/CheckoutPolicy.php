<?php

namespace App\Policies;

use App\Models\Checkout;
use App\Models\User;

class CheckoutPolicy
{
    /**
     * Determine whether the user can view any checkouts.
     */
    public function viewAny(User $user): bool
    {
        // Admin can see all checkouts, member can see their own
        return true;
    }

    /**
     * Determine whether the user can view the checkout.
     */
    public function view(User $user, Checkout $checkout): bool
    {
        // Admin can view any checkout, member can only view their own
        return $user->role === 'admin' || $user->id === $checkout->user_id;
    }

    /**
     * Determine whether the user can create checkouts.
     */
    public function create(User $user): bool
    {
        // Any authenticated user can create a checkout
        return $user->role === 'member' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the checkout.
     */
    public function update(User $user, Checkout $checkout): bool
    {
        // Only admin can update checkouts (status changes)
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the checkout.
     */
    public function delete(User $user, Checkout $checkout): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can cancel the checkout.
     */
    public function cancel(User $user, Checkout $checkout): bool
    {
        // User can cancel their own pending checkouts
        if ($user->id === $checkout->user_id && $checkout->status === 'pending') {
            return true;
        }
        
        // Admin can cancel any checkout
        return $user->role === 'admin';
    }
}
