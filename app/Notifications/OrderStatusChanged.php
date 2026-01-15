<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusChanged extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Status Pesanan Diperbarui',
            'message' => "Pesanan #{$this->order->invoice_number} Anda sekarang berstatus: " . ucfirst($this->order->status),
            'type' => 'order', 
            'order_id' => $this->order->id,
        ];
    }
}