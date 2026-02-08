<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockAlert extends Notification
{
    use Queueable;

    protected $sku;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Sku $sku)
    {
        $this->sku = $sku;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->error()
                    ->subject('Low Stock Alert: ' . $this->sku->sku_code)
                    ->line('A furniture variation has reached its low stock threshold.')
                    ->line('SKU: ' . $this->sku->sku_code)
                    ->line('Current Stock: ' . $this->sku->sku_stock)
                    ->line('Threshold: ' . $this->sku->low_stock_threshold)
                    ->action('Manage Product', url('/admin/manage-product'))
                    ->line('Please restock this item soon.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'sku_id' => $this->sku->sku_id,
            'sku_code' => $this->sku->sku_code,
            'current_stock' => $this->sku->sku_stock,
            'message' => "Stock for {$this->sku->sku_code} is low."
        ];
    }
}
