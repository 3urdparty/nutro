<?php

namespace App\Models;

use App\Notifications\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        Order::created(fn (Order $order) => $order->customer->user->notify(new OrderCreatedNotification($order)));
    }

    protected $with = ['items', 'payment'];
    protected $appends = ['order_number', 'subtotal'];
    protected $guarded = [];

    public function getOrderNumberAttribute()
    {
        return  "JBX-" . str_pad($this->id, 5, "0", STR_PAD_LEFT);
    }
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(FoodItem::class, 'order_items')->withPivot('quantity')->as('listing');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $id =  ltrim(ltrim($value, 'JBX-'), '0');
        return $this->where('id', $id)->firstOrFail();
    }

    // TODO: Fix this to return the right subtotal

    public function getSubtotalAttribute(): float
    {

        return $this->items->sum(function ($item) {

            return $item->price * $item->listing->quantity;
        });
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getHashAttribute(): string
    {

        $string = env('SENANG_PAY_SECRET_KEY') . $this->order_number . number_format($this->subtotal, 2, '.', '') . $this->id;
        $hash = hash_hmac('SHA256', $string, env('SENANG_PAY_SECRET_KEY'));
        return $hash;
    }

    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }
}
