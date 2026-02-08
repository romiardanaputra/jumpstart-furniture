<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Checkout;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class XenditCallbackTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('services.xendit.callback_token', 'test_token');
    }

    protected function createFullProduct($user, $category)
    {
        return Product::create([
            'user_id' => $user->id,
            'category_id' => $category->category_id,
            'product_name' => 'Test Sofa',
            'product_price' => 1000000,
            'product_type' => 'Furniture',
            'product_sku' => 'SOFA-001',
            'product_vendor' => 'JumpStart',
            'product_availability' => 'In Stock',
            'product_tags' => 'sofa,test',
            'product_color' => 'Grey',
            'product_material' => 'Fabric',
            'product_long_description' => 'A very comfortable test sofa.',
            'product_shipping_and_return' => 'Free shipping',
            'product_image' => 'test.jpg',
            'product_discount' => '0',
            'product_short_description' => 'A test sofa',
        ]);
    }

    /** @test */
    public function handles_paid_invoice_webhook_successfully()
    {
        $user = User::factory()->create();
        $category = Category::create(['category_name' => 'Test', 'category_slug' => 'test']);
        $product = $this->createFullProduct($user, $category);
        
        $sku = Sku::create([
            'product_id' => $product->product_id,
            'sku_code' => 'TEST-SKU',
            'price' => 1000000,
            'stock' => 10
        ]);

        $externalId = 'INV-TEST-123';

        Checkout::create([
            'user_id' => $user->id,
            'product_id' => $product->product_id,
            'sku_id' => $sku->sku_id,
            'cart_id' => 1,
            'payment_status' => 'pending',
            'payment_total_per_item' => 1000000,
            'xendit_external_id' => $externalId,
            'shipping_address' => 'Test Address',
            'shipping_price' => 50000,
            'shipping_method' => 'Standard',
        ]);

        $payload = [
            'external_id' => $externalId,
            'status' => 'PAID',
            'id' => 'xendit_id_123',
            'amount' => 1050000,
        ];

        $response = $this->withHeaders([
            'x-callback-token' => 'test_token'
        ])->postJson('/api/xendit/callback', $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('checkouts', [
            'xendit_external_id' => $externalId,
            'payment_status' => 'paid'
        ]);

        $this->assertEquals(9, $sku->fresh()->stock);
    }

    /** @test */
    public function handles_expired_invoice_webhook()
    {
        $user = User::factory()->create();
        $category = Category::create(['category_name' => 'Test', 'category_slug' => 'test']);
        $product = $this->createFullProduct($user, $category);
        
        $sku = Sku::create([
            'product_id' => $product->product_id,
            'sku_code' => 'TEST-SKU',
            'price' => 1000000,
            'stock' => 10
        ]);

        $externalId = 'INV-EXPIRED-JKL';

        Checkout::create([
            'user_id' => $user->id,
            'product_id' => $product->product_id,
            'sku_id' => $sku->sku_id,
            'cart_id' => 1,
            'payment_status' => 'pending',
            'payment_total_per_item' => 1000000,
            'xendit_external_id' => $externalId,
            'shipping_address' => 'Test Address',
            'shipping_price' => 50000,
            'shipping_method' => 'Standard',
        ]);

        $payload = [
            'external_id' => $externalId,
            'status' => 'EXPIRED',
        ];

        $response = $this->withHeaders([
            'x-callback-token' => 'test_token'
        ])->postJson('/api/xendit/callback', $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('checkouts', [
            'xendit_external_id' => $externalId,
            'payment_status' => 'expired'
        ]);
    }

    /** @test */
    public function rejects_invalid_callback_token()
    {
        $response = $this->withHeaders([
            'x-callback-token' => 'wrong_token'
        ])->postJson('/api/xendit/callback', [
            'external_id' => 'some_id',
            'status' => 'PAID'
        ]);

        $response->assertStatus(401);
    }
}
