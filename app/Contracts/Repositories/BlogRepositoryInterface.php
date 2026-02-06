<?php

namespace App\Contracts\Repositories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all published blogs
     */
    public function getPublished(): Collection;

    /**
     * Get blogs by tag
     */
    public function getByTag(string $tag): Collection;

    /**
     * Get recent blogs with limit
     */
    public function getRecent(int $limit = 5): Collection;

    /**
     * Get blogs by user (author)
     */
    public function getByUserId(int $userId): Collection;
}
