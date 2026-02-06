<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface BlogServiceInterface
{
    /**
     * Get all blogs
     */
    public function getAllBlogs(): Collection;

    /**
     * Get blog by ID
     */
    public function getBlog(int $blogId): ?Model;

    /**
     * Create a new blog
     */
    public function createBlog(array $data, ?UploadedFile $image = null): Model;

    /**
     * Update an existing blog
     */
    public function updateBlog(int $blogId, array $data, ?UploadedFile $image = null): bool;

    /**
     * Delete a blog
     */
    public function deleteBlog(int $blogId): bool;

    /**
     * Get blogs by user
     */
    public function getBlogsByUser(int $userId): Collection;

    /**
     * Get blogs by tag
     */
    public function getBlogsByTag(string $tag): Collection;
}
