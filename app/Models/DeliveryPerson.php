<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryPerson extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }

    public function completedDeliveries(): HasMany
    {
        return $this->hasMany(Delivery::class)->where('status', 'delivered');
    }
    public function pendingDeliveries(): HasMany
    {
        return $this->hasMany(Delivery::class)->where('status', 'pending');
    }

    public function inProgressDeliveries(): HasMany
    {
        return $this->hasMany(Delivery::class)->where('status', 'in_progress');
    }
}
