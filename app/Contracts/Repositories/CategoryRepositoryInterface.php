<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all categories with their attributes and values
     *
     * @return Collection
     */
    public function allWithAttributes(): Collection;

    /**
     * Find category by slug
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findBySlug(string $slug);
}
