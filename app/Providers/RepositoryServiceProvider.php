<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repository Interfaces
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\CartRepositoryInterface;
use App\Contracts\Repositories\CheckoutRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Repositories\BlogRepositoryInterface;

// Repository Implementations
use App\Repositories\EloquentProductRepository;
use App\Repositories\EloquentCartRepository;
use App\Repositories\EloquentCheckoutRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentBlogRepository;

// Service Interfaces
use App\Contracts\Services\PaymentServiceInterface;

// Service Implementations
use App\Services\PaymentService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     * Using $bindings for performance (singleton-like behavior)
     *
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        // Repository bindings
        ProductRepositoryInterface::class => EloquentProductRepository::class,
        CartRepositoryInterface::class => EloquentCartRepository::class,
        CheckoutRepositoryInterface::class => EloquentCheckoutRepository::class,
        UserRepositoryInterface::class => EloquentUserRepository::class,
        BlogRepositoryInterface::class => EloquentBlogRepository::class,

        // Service bindings
        PaymentServiceInterface::class => PaymentService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        // Bindings are automatically registered via $bindings property
        // Add any additional manual bindings here if needed
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
