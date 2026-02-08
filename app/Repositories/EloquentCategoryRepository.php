<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all categories with their attributes and values
     *
     * @return Collection
     */
    public function allWithAttributes(): Collection
    {
        return $this->model->with(['attributes.values'])->get();
    }

    /**
     * Find category by slug
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findBySlug(string $slug)
    {
        return $this->model->where('category_slug', $slug)->first();
    }
}
