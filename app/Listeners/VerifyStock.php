<?php

namespace App\Listeners;

use App\Events\CartUpdated;
use App\Contracts\Repositories\SkuRepositoryInterface;
use Illuminate\Support\Facades\Log;

class VerifyStock
{
    protected SkuRepositoryInterface $skuRepo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SkuRepositoryInterface $skuRepo)
    {
        $this->skuRepo = $skuRepo;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CartUpdated  $event
     * @return void
     */
    public function handle(CartUpdated $event)
    {
        $cart = $event->cart;
        
        if (!$cart->sku_id) {
            return;
        }

        if (!$this->skuRepo->hasStock($cart->sku_id, $cart->quantity)) {
            Log::warning('Low stock detected for SKU during cart update', [
                'sku_id' => $cart->sku_id,
                'requested_quantity' => $cart->quantity,
                'cart_id' => $cart->cart_id
            ]);
            
            // In a real application, we might throw an exception or flash a message
            // for now, we just log it as per enterprise monitoring patterns.
        }
    }
}
