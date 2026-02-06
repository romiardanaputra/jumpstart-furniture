<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Get all users
     */
    public function getAllUsers(): Collection
    {
        return $this->userRepo->all();
    }

    /**
     * Get user by ID
     */
    public function getUser(int $userId): ?Model
    {
        return $this->userRepo->findById($userId);
    }

    /**
     * Create a new user
     */
    public function createUser(array $data): Model
    {
        return $this->handleTransaction(function () use ($data) {
            // Sanitize input
            $sanitizedData = $this->sanitizeUserData($data);
            
            // Hash password
            if (isset($sanitizedData['password'])) {
                $sanitizedData['password'] = Hash::make($sanitizedData['password']);
            }

            $user = $this->userRepo->create($sanitizedData);

            $this->logAction('User created', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return $user;
        });
    }

    /**
     * Update an existing user
     */
    public function updateUser(int $userId, array $data): bool
    {
        return $this->handleTransaction(function () use ($userId, $data) {
            // Sanitize input
            $sanitizedData = $this->sanitizeUserData($data);
            
            // Remove password if not being updated
            unset($sanitizedData['password']);

            $updated = $this->userRepo->update($userId, $sanitizedData);

            $this->logAction('User updated', [
                'user_id' => $userId,
            ]);

            return $updated;
        });
    }

    /**
     * Delete a user
     */
    public function deleteUser(int $userId): bool
    {
        return $this->handleTransaction(function () use ($userId) {
            $deleted = $this->userRepo->delete($userId);

            $this->logAction('User deleted', [
                'user_id' => $userId,
            ]);

            return $deleted;
        });
    }

    /**
     * Get users by role
     */
    public function getUsersByRole(string $role): Collection
    {
        return $this->userRepo->getByRole($role);
    }

    /**
     * Update user password
     */
    public function updatePassword(int $userId, string $password): bool
    {
        return $this->handleTransaction(function () use ($userId, $password) {
            $hashedPassword = Hash::make($password);
            
            $updated = $this->userRepo->update($userId, [
                'password' => $hashedPassword,
            ]);

            $this->logAction('User password updated', [
                'user_id' => $userId,
            ]);

            return $updated;
        });
    }

    /**
     * Sanitize user data
     */
    protected function sanitizeUserData(array $data): array
    {
        $sanitized = [];
        
        $stringFields = ['first_name', 'last_name', 'email', 'contact', 'role'];
        
        foreach ($stringFields as $field) {
            if (isset($data[$field])) {
                $sanitized[$field] = strip_tags(trim($data[$field]));
            }
        }

        // Keep password as-is (will be hashed separately)
        if (isset($data['password'])) {
            $sanitized['password'] = $data['password'];
        }

        return $sanitized;
    }
}
