<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\InventoryService;
use App\Contracts\Repositories\SkuRepositoryInterface;
use App\Models\Sku;
use App\Events\LowStockDetected;
use Illuminate\Support\Facades\Event;
use Mockery;

class InventoryServiceTest extends TestCase
{
    protected $skuRepo;
    protected $inventoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->skuRepo = Mockery::mock(SkuRepositoryInterface::class);
        $this->inventoryService = new InventoryService($this->skuRepo);
    }

    public function test_it_can_get_stock_level()
    {
        $sku = new Sku(['sku_stock' => 50]);
        $this->skuRepo->shouldReceive('findById')->with(1)->andReturn($sku);

        $stock = $this->inventoryService->getStockLevel(1);

        $this->assertEquals(50, $stock);
    }

    public function test_it_triggers_low_stock_event_when_threshold_reached()
    {
        Event::fake();

        $sku = Mockery::mock(Sku::class)->makePartial();
        $sku->sku_id = 1;
        $sku->sku_code = 'TEST-SKU';
        $sku->sku_stock = 4; // Below threshold of 5
        $sku->low_stock_threshold = 5;

        $this->skuRepo->shouldReceive('decreaseStock')->with(1, 1)->andReturn(true);
        $this->skuRepo->shouldReceive('findById')->with(1)->andReturn($sku);

        $this->inventoryService->deductStock(1, 1);

        Event::assertDispatched(LowStockDetected::class, function ($event) use ($sku) {
            return $event->sku->sku_id === $sku->sku_id;
        });
    }

    public function test_it_does_not_trigger_event_if_above_threshold()
    {
        Event::fake();

        $sku = Mockery::mock(Sku::class)->makePartial();
        $sku->sku_id = 1;
        $sku->sku_stock = 10;
        $sku->low_stock_threshold = 5;

        $this->skuRepo->shouldReceive('decreaseStock')->with(1, 1)->andReturn(true);
        $this->skuRepo->shouldReceive('findById')->with(1)->andReturn($sku);

        $this->inventoryService->deductStock(1, 1);

        Event::assertNotDispatched(LowStockDetected::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
