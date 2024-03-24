<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;
    use HasFactory;


    protected $fillable = [
        'customer_id'
    ];
    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function foodItems():BelongsToMany
    {
        return $this->belongsToMany(FoodItem::class, 'cart_items')->using(CartItem::class)->withPivot(['quantity', 'id'])->as('listing');
    }
}
