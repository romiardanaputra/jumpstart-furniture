<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Get users by role
     */
    public function getByRole(string $role): Collection;

    /**
     * Update user role
     */
    public function updateRole(int $userId, string $role): bool;
}
