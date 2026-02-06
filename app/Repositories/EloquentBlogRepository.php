<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Contracts\Repositories\BlogRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentBlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all published blogs
     */
    public function getPublished(): Collection
    {
        return $this->model
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * Get blogs by tag
     */
    public function getByTag(string $tag): Collection
    {
        return $this->model
            ->where('blog_tags', 'LIKE', "%{$tag}%")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get recent blogs with limit
     */
    public function getRecent(int $limit = 5): Collection
    {
        return $this->model
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
