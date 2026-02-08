<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repository Interfaces
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\CartRepositoryInterface;
use App\Contracts\Repositories\CheckoutRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Repositories\BlogRepositoryInterface;
use App\Contracts\Repositories\SkuRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\ReviewRepositoryInterface;
use App\Contracts\Repositories\WishlistRepositoryInterface;
use App\Contracts\Repositories\CouponRepositoryInterface;

// Repository Implementations
use App\Repositories\EloquentProductRepository;
use App\Repositories\EloquentCartRepository;
use App\Repositories\EloquentCheckoutRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentBlogRepository;
use App\Repositories\EloquentSkuRepository;
use App\Repositories\EloquentCategoryRepository;
use App\Repositories\EloquentReviewRepository;
use App\Repositories\EloquentWishlistRepository;
use App\Repositories\EloquentCouponRepository;

// Service Interfaces
use App\Contracts\Services\PaymentServiceInterface;
use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Services\CartServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Services\BlogServiceInterface;
use App\Contracts\Services\InventoryServiceInterface;
use App\Contracts\Services\LogisticsServiceInterface;
use App\Contracts\Services\ReviewServiceInterface;
use App\Contracts\Services\WishlistServiceInterface;
use App\Contracts\Services\CouponServiceInterface;

// Service Implementations
use App\Services\PaymentService;
use App\Services\ProductService;
use App\Services\CartService;
use App\Services\UserService;
use App\Services\BlogService;
use App\Services\InventoryService;
use App\Services\LogisticsService;
use App\Services\ReviewService;
use App\Services\WishlistService;
use App\Services\CouponService;

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
        SkuRepositoryInterface::class => EloquentSkuRepository::class,
        CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
        ReviewRepositoryInterface::class => EloquentReviewRepository::class,
        WishlistRepositoryInterface::class => EloquentWishlistRepository::class,
        CouponRepositoryInterface::class => EloquentCouponRepository::class,

        // Service bindings
        PaymentServiceInterface::class => PaymentService::class,
        ProductServiceInterface::class => ProductService::class,
        CartServiceInterface::class => CartService::class,
        UserServiceInterface::class => UserService::class,
        BlogServiceInterface::class => BlogService::class,
        InventoryServiceInterface::class => InventoryService::class,
        LogisticsServiceInterface::class => LogisticsService::class,
        ReviewServiceInterface::class => ReviewService::class,
        WishlistServiceInterface::class => WishlistService::class,
        CouponServiceInterface::class => CouponService::class,
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
