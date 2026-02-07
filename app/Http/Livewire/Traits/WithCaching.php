<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Trait for caching data in Livewire components
 * Provides a simple interface for cache-through pattern
 */
trait WithCaching
{
    /**
     * Default cache TTL in seconds (5 minutes)
     */
    protected int $defaultCacheTtl = 300;

    /**
     * Get cached data or execute callback and cache the result
     */
    protected function remember(string $key, callable $callback, ?int $ttl = null): mixed
    {
        $ttl = $ttl ?? $this->defaultCacheTtl;
        
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Get cached data or execute callback (tags-based for easy invalidation)
     */
    protected function rememberWithTags(array $tags, string $key, callable $callback, ?int $ttl = null): mixed
    {
        $ttl = $ttl ?? $this->defaultCacheTtl;
        
        return Cache::tags($tags)->remember($key, $ttl, $callback);
    }

    /**
     * Forget cache by key
     */
    protected function forgetCache(string $key): bool
    {
        return Cache::forget($key);
    }

    /**
     * Forget cache by tags
     */
    protected function forgetCacheByTags(array $tags): bool
    {
        return Cache::tags($tags)->flush();
    }

    /**
     * Clear all model-related cache when data changes
     */
    protected function clearModelCache(string $model): void
    {
        // Clear common cache keys for this model
        $keys = [
            "{$model}_all",
            "{$model}_featured",
            "{$model}_available",
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }
}
