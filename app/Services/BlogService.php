<?php

namespace App\Services;

use App\Contracts\Repositories\BlogRepositoryInterface;
use App\Contracts\Services\BlogServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogService extends BaseService implements BlogServiceInterface
{
    protected BlogRepositoryInterface $blogRepo;

    public function __construct(BlogRepositoryInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    /**
     * Get all blogs
     */
    public function getAllBlogs(): Collection
    {
        return $this->blogRepo->all();
    }

    /**
     * Get blog by ID
     */
    public function getBlog(int $blogId): ?Model
    {
        return $this->blogRepo->findById($blogId);
    }

    /**
     * Create a new blog
     */
    public function createBlog(array $data, ?UploadedFile $image = null): Model
    {
        return $this->handleTransaction(function () use ($data, $image) {
            $sanitizedData = $this->sanitizeBlogData($data);
            
            // Handle image upload
            if ($image) {
                $sanitizedData['blog_image'] = $this->uploadImage($image);
            }

            $blog = $this->blogRepo->create($sanitizedData);

            $this->logAction('Blog created', [
                'blog_id' => $blog->blog_id ?? $blog->id,
                'title' => $blog->blog_title,
            ]);

            return $blog;
        });
    }

    /**
     * Update an existing blog
     */
    public function updateBlog(int $blogId, array $data, ?UploadedFile $image = null): bool
    {
        return $this->handleTransaction(function () use ($blogId, $data, $image) {
            $sanitizedData = $this->sanitizeBlogData($data);
            
            // Handle image upload
            if ($image) {
                // Delete old image
                $blog = $this->blogRepo->findById($blogId);
                if ($blog && $blog->blog_image) {
                    Storage::delete($blog->blog_image);
                }
                
                $sanitizedData['blog_image'] = $this->uploadImage($image);
            }

            $updated = $this->blogRepo->update($blogId, $sanitizedData);

            $this->logAction('Blog updated', [
                'blog_id' => $blogId,
            ]);

            return $updated;
        });
    }

    /**
     * Delete a blog
     */
    public function deleteBlog(int $blogId): bool
    {
        return $this->handleTransaction(function () use ($blogId) {
            // Delete image first
            $blog = $this->blogRepo->findById($blogId);
            if ($blog && $blog->blog_image) {
                Storage::delete($blog->blog_image);
            }

            $deleted = $this->blogRepo->delete($blogId);

            $this->logAction('Blog deleted', [
                'blog_id' => $blogId,
            ]);

            return $deleted;
        });
    }

    /**
     * Get blogs by user
     */
    public function getBlogsByUser(int $userId): Collection
    {
        return $this->blogRepo->getByUserId($userId);
    }

    /**
     * Get blogs by tag
     */
    public function getBlogsByTag(string $tag): Collection
    {
        return $this->blogRepo->getByTag($tag);
    }

    /**
     * Upload image and return path
     */
    protected function uploadImage(UploadedFile $image): string
    {
        return $image->store('blog_images', 'public');
    }

    /**
     * Sanitize blog data
     */
    protected function sanitizeBlogData(array $data): array
    {
        $sanitized = [];

        if (isset($data['blog_title'])) {
            $sanitized['blog_title'] = strip_tags(trim($data['blog_title']));
        }

        if (isset($data['blog_tags'])) {
            $sanitized['blog_tags'] = strip_tags(trim($data['blog_tags']));
        }

        if (isset($data['blog_long_description'])) {
            // Allow some safe HTML for blog content
            $allowed = '<p><br><strong><em><ul><ol><li><h2><h3><h4><a>';
            $sanitized['blog_long_description'] = strip_tags(trim($data['blog_long_description']), $allowed);
        }

        if (isset($data['user_id'])) {
            $sanitized['user_id'] = (int) $data['user_id'];
        }

        return $sanitized;
    }
}
