<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Checkout;
use App\Models\Review;
use App\Http\Livewire\LeaveReview;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReviewSystemTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function users_can_submit_reviews_with_photos()
    {
        Storage::fake('public');
        $this->actingAs($this->user);

        $file = UploadedFile::fake()->image('review_photo.jpg');

        Livewire::test(LeaveReview::class, ['productId' => $this->product->product_id])
            ->set('rating', 5)
            ->set('comment', 'This is a high-quality furniture piece!')
            ->set('images', [$file])
            ->call('submitReview');

        $this->assertDatabaseHas('reviews', [
            'product_id' => $this->product->product_id,
            'user_id' => $this->user->id,
            'rating' => 5,
        ]);

        $review = Review::first();
        $this->assertCount(1, $review->images);
        $this->assertFalse($review->is_verified); // No purchase yet
    }

    /** @test */
    public function reviews_from_customers_are_marked_as_verified()
    {
        $this->actingAs($this->user);

        // Create a cart for this product first
        $cart = \App\Models\Cart::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->product_id,
            'sku_id' => null, 
            'quantity' => 1,
            'total_price' => 100000,
        ]);

        // Create a paid checkout for this product
        Checkout::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->product_id,
            'cart_id' => $cart->cart_id,
            'payment_status' => 'paid',
            'shipping_address' => 'Test Address',
            'shipping_price' => 20000,
            'payment_total' => 100000,
        ]);

        Livewire::test(LeaveReview::class, ['productId' => $this->product->product_id])
            ->set('rating', 4)
            ->set('comment', 'Loved the product after buying it!')
            ->call('submitReview');

        $this->assertTrue(Review::first()->is_verified);
    }

    /** @test */
    public function comment_validation_prevents_short_reviews()
    {
        $this->actingAs($this->user);

        Livewire::test(LeaveReview::class, ['productId' => $this->product->product_id])
            ->set('rating', 5)
            ->set('comment', 'Too short')
            ->call('submitReview')
            ->assertHasErrors(['comment' => 'min']);
    }
}
