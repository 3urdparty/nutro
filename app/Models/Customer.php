<?php

namespace App\Models;

use App\Notifications\BaseNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Customer extends Model
{
    use HasFactory;


    protected $with = ['user'];

    protected $guarded = [];

    protected static function booted()
    {
        static::created(
            fn (Customer $customer) =>
            $customer->cart()->create()
        );
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function notifications(): HasManyThrough
    {
        return $this->hasManyThrough(
            BaseNotification::class,
            User::class
        );
    }
}
