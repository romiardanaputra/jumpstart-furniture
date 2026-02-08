<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ShippingRate;
use App\Services\LogisticsService;
use App\Services\RajaOngkirService;
use App\Contracts\Repositories\CartRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ShippingSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup a test user
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_uses_local_override_for_jakarta_free_shipping()
    {
        // 1. Arrange: Create local rate for Jakarta (151)
        ShippingRate::create([
            'origin_city_id' => 114,
            'destination_city_id' => 151,
            'courier_code' => 'jne',
            'base_rate' => 20000,
            'free_shipping_threshold' => 5000000, // 5jt free
            'is_active' => true,
        ]);

        // Mock Cart Repository to return value > threshold
        $mockCartRepo = Mockery::mock(CartRepositoryInterface::class);
        $mockCartRepo->shouldReceive('calculateTotal')->andReturn(6000000);
        $this->app->instance(CartRepositoryInterface::class, $mockCartRepo);

        $rajaOngkir = Mockery::mock(RajaOngkirService::class);
        $logistics = new LogisticsService($rajaOngkir);

        // 2. Act
        $rate = $logistics->calculateShippingRate('151', 2.0, 'jne');

        // 3. Assert
        $this->assertEquals(0, $rate, 'Jakarta shipping should be free for orders > 5jt');
    }

    /** @test */
    public function it_falls_back_to_rajaongkir_for_non_overridden_cities()
    {
        // 1. Arrange: Mock RajaOngkir to return a specific rate
        $rajaOngkir = Mockery::mock(RajaOngkirService::class);
        $rajaOngkir->shouldReceive('calculateCost')->andReturn([
            [
                'costs' => [
                    [
                        'cost' => [['value' => 35000]]
                    ]
                ]
            ]
        ]);

        $mockCartRepo = Mockery::mock(CartRepositoryInterface::class);
        $mockCartRepo->shouldReceive('calculateTotal')->andReturn(100000);
        $this->app->instance(CartRepositoryInterface::class, $mockCartRepo);

        $logistics = new LogisticsService($rajaOngkir);

        // 2. Act: City 99 is not in local overrides
        $rate = $logistics->calculateShippingRate('99', 1.0, 'jne');

        // 3. Assert
        $this->assertEquals(35000, $rate);
    }

    /** @test */
    public function it_applies_base_rate_when_below_threshold()
    {
        // 1. Arrange: Create local rate
        ShippingRate::create([
            'origin_city_id' => 114,
            'destination_city_id' => 444, // Surabaya
            'courier_code' => 'jne',
            'base_rate' => 15000,
            'free_shipping_threshold' => 3000000,
            'is_active' => true,
        ]);

        // Mock Cart Repository to return value < threshold
        $mockCartRepo = Mockery::mock(CartRepositoryInterface::class);
        $mockCartRepo->shouldReceive('calculateTotal')->andReturn(500000);
        $this->app->instance(CartRepositoryInterface::class, $mockCartRepo);

        $rajaOngkir = Mockery::mock(RajaOngkirService::class);
        $logistics = new LogisticsService($rajaOngkir);

        // 2. Act
        $rate = $logistics->calculateShippingRate('444', 2.0, 'jne');

        // 3. Assert
        $this->assertEquals(30000, $rate, 'Rate should be 2kg * 15000');
    }
}
