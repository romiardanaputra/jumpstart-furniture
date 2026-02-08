<?php

namespace Tests\Feature;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\User;
use App\Http\Livewire\ShoppingCart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CouponSystemTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function can_apply_valid_percentage_coupon()
    {
        $this->actingAs($this->user);

        $coupon = Coupon::create([
            'code' => 'SAVE20',
            'type' => 'percentage',
            'value' => 20,
            'is_active' => true,
        ]);

        Livewire::test(ShoppingCart::class)
            ->set('subtotal_payment', 1000000)
            ->set('coupon_code', 'SAVE20')
            ->call('applyCoupon')
            ->assertSet('discount_amount', 200000)
            ->assertSet('total_payment', 800000)
            ->assertSet('is_coupon_valid', true);
    }

    /** @test */
    public function can_apply_valid_fixed_coupon()
    {
        $this->actingAs($this->user);

        $coupon = Coupon::create([
            'code' => 'FLAT50',
            'type' => 'fixed',
            'value' => 50000,
            'is_active' => true,
        ]);

        Livewire::test(ShoppingCart::class)
            ->set('subtotal_payment', 1000000)
            ->set('coupon_code', 'FLAT50')
            ->call('applyCoupon')
            ->assertSet('discount_amount', 50000)
            ->assertSet('total_payment', 950000);
    }

    /** @test */
    public function cannot_apply_expired_coupon()
    {
        $this->actingAs($this->user);

        $coupon = Coupon::create([
            'code' => 'EXPIRED',
            'type' => 'fixed',
            'value' => 10000,
            'expires_at' => now()->subDay(),
            'is_active' => true,
        ]);

        Livewire::test(ShoppingCart::class)
            ->set('subtotal_payment', 1000000)
            ->set('coupon_code', 'EXPIRED')
            ->call('applyCoupon')
            ->assertSet('is_coupon_valid', false)
            ->assertSet('coupon_message', 'Coupon is expired, inactive, or order total is too low.');
    }

    /** @test */
    public function cannot_apply_coupon_with_usage_limit_reached()
    {
        $this->actingAs($this->user);

        $coupon = Coupon::create([
            'code' => 'LIMITED',
            'type' => 'fixed',
            'value' => 10000,
            'usage_limit' => 1,
            'used_count' => 1,
            'is_active' => true,
        ]);

        Livewire::test(ShoppingCart::class)
            ->set('subtotal_payment', 1000000)
            ->set('coupon_code', 'LIMITED')
            ->call('applyCoupon')
            ->assertSet('is_coupon_valid', false);
    }

    /** @test */
    public function respects_minimum_order_amount()
    {
        $this->actingAs($this->user);

        $coupon = Coupon::create([
            'code' => 'BIGBUY',
            'type' => 'fixed',
            'value' => 100000,
            'min_order_amount' => 500000,
            'is_active' => true,
        ]);

        Livewire::test(ShoppingCart::class)
            ->set('subtotal_payment', 300000)
            ->set('coupon_code', 'BIGBUY')
            ->call('applyCoupon')
            ->assertSet('is_coupon_valid', false)
            ->assertSet('coupon_message', 'Coupon is expired, inactive, or order total is too low.');
    }
}
