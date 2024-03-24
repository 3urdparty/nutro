<?php

namespace App\Notifications;

use App\Notifications\DatabaseNotification;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends BaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Order <b>' . $this->order->order_number . '</b> has been placed',
            'url' => route('orders.show', $this->order->id)
        ];
    }
}
