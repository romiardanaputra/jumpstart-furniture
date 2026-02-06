<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The model instance
     */
    protected Model $model;

    /**
     * Create a new repository instance
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records with optional relations
     * Implements eager loading to prevent N+1 problem
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Find record by ID with optional relations
     */
    public function findById(int $id, array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id);
    }

    /**
     * Find record with pessimistic lock for update
     * Use this for concurrent operations (payments, stock updates)
     */
    public function findWithLock(int $id): ?Model
    {
        return $this->model
            ->where($this->model->getKeyName(), $id)
            ->lockForUpdate()
            ->first();
    }

    /**
     * Create a new record
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update record by ID
     */
    public function update(int $id, array $data): bool
    {
        return $this->model
            ->where($this->model->getKeyName(), $id)
            ->update($data) > 0;
    }

    /**
     * Delete record by ID
     */
    public function delete(int $id): bool
    {
        return $this->model
            ->where($this->model->getKeyName(), $id)
            ->delete() > 0;
    }

    /**
     * Get the model's primary key name
     */
    protected function getKeyName(): string
    {
        return $this->model->getKeyName();
    }
}
