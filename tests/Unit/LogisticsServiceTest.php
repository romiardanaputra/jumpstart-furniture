<?php

namespace Tests\Unit;

use App\Services\LogisticsService;
use Tests\TestCase;

class LogisticsServiceTest extends TestCase
{
    protected LogisticsService $logisticsService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->logisticsService = new LogisticsService();
    }

    /** @test */
    public function it_calculates_volumetric_weight_correctly()
    {
        // Sofa dimensions: 200x100x80 cm
        // (200 * 100 * 80) / 6000 = 1,600,000 / 6000 = 266.67
        $volumetric = $this->logisticsService->calculateVolumetricWeight(200, 100, 80);
        
        $this->assertEquals(266.6666666666667, $volumetric);
    }

    /** @test */
    public function it_calculates_chargable_weight_as_max_of_actual_and_volumetric()
    {
        // Scenario 1: Actual weight is greater (Lead blocks)
        $weight1 = $this->logisticsService->getChargableWeight(50, 10, 10, 10);
        $this->assertEquals(50, $weight1);

        // Scenario 2: Volumetric weight is greater (Sofa)
        $weight2 = $this->logisticsService->getChargableWeight(40, 200, 100, 80);
        $this->assertEquals(266.6666666666667, $weight2);
    }

    /** @test */
    public function it_calculates_shipping_rate_with_destination_multiplier()
    {
        // Destination: Jakarta (Multiplier 1.0)
        // Weight: 10kg
        // Courier: JNE (Rate 15000)
        // Total: 10 * 15000 * 1.0 = 150000
        $rate1 = $this->logisticsService->calculateShippingRate('Jakarta Selatan', 10, 'jne');
        $this->assertEquals(150000, $rate1);

        // Destination: Surabaya (Multiplier 1.5)
        // Total: 10 * 15000 * 1.5 = 225000
        $rate2 = $this->logisticsService->calculateShippingRate('Surabaya', 10, 'jne');
        $this->assertEquals(225000, $rate2);
    }
}
