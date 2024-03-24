<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'customer_id',
        'reviewable_id',
        'reviewable_type',
        'body',
        'title',


    ];

    protected $with = [
        'customer'
    ];
    public function reviewable():MorphTo
    {
        return $this->morphTo();
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
