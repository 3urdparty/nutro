<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $with = ['order'];

    protected const STATUS = ['pending', 'in_progress', 'delivered', 'cancelled'];
    protected $appends = ['minimum_distance', 'maximum_distance', 'from','to'];
    protected $casts = [
        'from_latitude' => 'float',
        'to_latitude' => 'float',
        'from_longitude' => 'float',
        'to_longitude' => 'float',
    ];
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getMinimumDistanceAttribute(): float
    {
        return 10;
    }
    public function getMaximumDistanceAttribute(): float
    {
        return 20;
    }

    public function from(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => [
                'first_line_address' => $this->from_first_line_address,
                'second_line_address' => $this->from_second_line_address,
                'state' => $this->from_state,
                'city' => $this->from_city,
                'postcode' => $this->from_postcode,
                'country' => $this->from_country,
                'coord' => [
                    'lat' => $this->from_latitude,
                    'lng' => $this->from_longitude,
                ]
            ]
        );
    }

    public function to(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => [
                'first_line_address' => $this->to_first_line_address,
                'second_line_address' => $this->to_second_line_address,
                'state' => $this->to_state,
                'city' => $this->to_city,
                'postcode' => $this->to_postcode,
                'country' => $this->to_country,
                'coord' => [
                    'lat' => $this->to_latitude,
                    'lng' => $this->to_longitude,
                ]
            ]
        );
    }
}
