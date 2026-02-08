<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Http\Livewire\WishlistButton;
use App\Http\Livewire\WishlistPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WishlistSystemTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        
        $category = \App\Models\Category::create([
            'category_name' => 'Test Category',
            'category_slug' => 'test-category'
        ]);

        $this->product = Product::factory()->create([
            'category_id' => $category->category_id
        ]);

        \App\Models\Sku::create([
            'product_id' => $this->product->product_id,
            'sku_code' => 'TEST-SKU',
            'sku_price' => 100000,
            'sku_stock' => 10,
            'sku_weight' => 1,
        ]);
    }

    /** @test */
    public function user_can_toggle_product_in_wishlist()
    {
        $this->actingAs($this->user);

        Livewire::test(WishlistButton::class, ['productId' => $this->product->product_id])
            ->call('toggle')
            ->assertSet('isWishlisted', true)
            ->call('toggle')
            ->assertSet('isWishlisted', false);

        $this->assertCount(0, Wishlist::all());
    }

    /** @test */
    public function guest_is_redirected_to_login_when_toggling_wishlist()
    {
        Livewire::test(WishlistButton::class, ['productId' => $this->product->product_id])
            ->call('toggle')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function wishlist_page_displays_saved_products()
    {
        $this->actingAs($this->user);
        
        Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->product_id
        ]);

        Livewire::test(WishlistPage::class)
            ->assertSee($this->product->product_name);
    }

    /** @test */
    public function wishlist_analytics_calculates_correct_popularity()
    {
        $user2 = User::factory()->create();
        $product2 = Product::factory()->create();

        // Product 1 has 2 saves
        Wishlist::create(['user_id' => $this->user->id, 'product_id' => $this->product->product_id]);
        Wishlist::create(['user_id' => $user2->id, 'product_id' => $this->product->product_id]);

        // Product 2 has 1 save
        Wishlist::create(['user_id' => $this->user->id, 'product_id' => $product2->product_id]);

        $service = app(\App\Contracts\Services\WishlistServiceInterface::class);
        $analytics = $service->getWishlistAnalytics();

        $this->assertEquals($this->product->product_id, $analytics->first()->product_id);
        $this->assertEquals(2, $analytics->first()->wishlist_count);
    }
}
