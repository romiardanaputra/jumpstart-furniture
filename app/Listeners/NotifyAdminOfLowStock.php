<?php

namespace App\Listeners;

use App\Events\LowStockDetected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfLowStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LowStockDetected  $event
     * @return void
     */
    public function handle(LowStockDetected $event)
    {
        // Notify all admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        
        \Illuminate\Support\Facades\Notification::send(
            $admins, 
            new \App\Notifications\LowStockAlert($event->sku)
        );
    }
}
