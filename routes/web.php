<?php

use App\Http\Livewire\About;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\Blog;
use App\Http\Livewire\BlogDetail;
use App\Http\Livewire\Contact;
use App\Http\Livewire\InfoStatus;
use App\Http\Livewire\Landing;
use App\Http\Livewire\Login;
use App\Http\Livewire\ManageBlog;
use App\Http\Livewire\ManageProduct;
use App\Http\Livewire\ManageUser;
use App\Http\Livewire\Payment;
use App\Http\Livewire\ProductDetail;
use App\Http\Livewire\Register;
use App\Http\Livewire\Shipping;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\Term;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Shop;

// Public discovery routes
Route::get('/', Landing::class)->name('landing');
Route::get('shop', Shop::class)->name('shop');
Route::get('product-detail/{product_id}', ProductDetail::class)->name('product-detail');
Route::get('about', About::class)->name('about');
Route::get('term', Term::class)->name('term');
Route::get('blog', Blog::class)->name('blog');
Route::get('blog/{blog_id}', BlogDetail::class)->name('blog-detail');
Route::get('contact', Contact::class)->name('contact');

// only guest can access
Route::middleware('guest')->group(function () {
    Route::get('register', Register::class)->name('register');
    Route::get('login', Login::class)->name('login');
});

// only authenticated user can access
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('features.user.dashboard');
    })->name('dashboard');

    Route::middleware('role:member')->group(function () {
        Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');
        Route::get('info-status', InfoStatus::class)->name('info-status');
        Route::get('shipping', Shipping::class)->name('shipping');
        Route::get('payment', Payment::class)->name('payment');
        Route::post('payment', Payment::class)->name('payment-post');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
        Route::get('manage-product', ManageProduct::class)->name('manage-product');
        Route::get('manage-user', ManageUser::class)->name('manage-user');
        Route::get('manage-blog', ManageBlog::class)->name('manage-blog');
    });
});
