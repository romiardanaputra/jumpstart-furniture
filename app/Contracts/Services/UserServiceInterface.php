<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    /**
     * Get all users
     */
    public function getAllUsers(): Collection;

    /**
     * Get user by ID
     */
    public function getUser(int $userId): ?Model;

    /**
     * Create a new user
     */
    public function createUser(array $data): Model;

    /**
     * Update an existing user
     */
    public function updateUser(int $userId, array $data): bool;

    /**
     * Delete a user
     */
    public function deleteUser(int $userId): bool;

    /**
     * Get users by role
     */
    public function getUsersByRole(string $role): Collection;

    /**
     * Update user password
     */
    public function updatePassword(int $userId, string $password): bool;
}
