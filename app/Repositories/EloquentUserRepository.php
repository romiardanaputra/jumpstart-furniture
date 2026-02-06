<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    /**
     * Get users by role
     */
    public function getByRole(string $role): Collection
    {
        return $this->model
            ->where('role', $role)
            ->get();
    }

    /**
     * Update user role
     */
    public function updateRole(int $userId, string $role): bool
    {
        return $this->update($userId, [
            'role' => $role,
        ]);
    }
}
