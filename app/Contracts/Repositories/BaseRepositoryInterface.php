<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    /**
     * Get all records with optional relations
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Find record by ID with optional relations
     */
    public function findById(int $id, array $relations = []): ?Model;

    /**
     * Find record with pessimistic lock for update
     */
    public function findWithLock(int $id): ?Model;

    /**
     * Create a new record
     */
    public function create(array $data): Model;

    /**
     * Update record by ID
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete record by ID
     */
    public function delete(int $id): bool;
}
