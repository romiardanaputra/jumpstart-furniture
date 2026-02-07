<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Determine whether the user can view any blogs.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Everyone can view blogs
    }

    /**
     * Determine whether the user can view the blog.
     */
    public function view(?User $user, Blog $blog): bool
    {
        return true; // Everyone can view a blog
    }

    /**
     * Determine whether the user can create blogs.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the blog.
     */
    public function update(User $user, Blog $blog): bool
    {
        // Admin can update any blog, or author can update their own
        return $user->role === 'admin' || $user->id === $blog->user_id;
    }

    /**
     * Determine whether the user can delete the blog.
     */
    public function delete(User $user, Blog $blog): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the blog.
     */
    public function restore(User $user, Blog $blog): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the blog.
     */
    public function forceDelete(User $user, Blog $blog): bool
    {
        return $user->role === 'admin';
    }
}
