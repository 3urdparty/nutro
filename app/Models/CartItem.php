<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartItem extends Pivot
{
    protected $with = ['foodItem'];
    protected $table = 'cart_items';
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function foodItem(): BelongsTo
    {
        return $this->belongsTo(FoodItem::class);
    }

}
