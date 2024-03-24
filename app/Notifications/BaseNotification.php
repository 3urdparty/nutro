<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notification ;

class BaseNotification extends Notification
{
    use Queueable;
    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getCategory()
    {
        return 'order';
    }

    public function via()
    {
        return ['database'];
    }

    public function toArray(User $notifiable):array
    {
        return [
          'name' => $notifiable->name,
          'email' => $notifiable->email
        ];
    }
}
// class Notification extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'body',
//         'link',
//         'type',
//         'category',
//         'status'
//     ];

//     const STATUSES = [
//         'read',
//         'unread',
//         'archived'
//     ];

//     public function markAsRead()
//     {
//         $this->status = 'read';
//         $this->save();
//     }

//     public function markAsUnread()
//     {
//         $this->status = 'unread';
//         $this->save();
//     }


// }
