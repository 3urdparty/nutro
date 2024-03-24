<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Support\Str;

class FoodItem extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory;


    protected $with = ['reviews'];
    protected $appends = ['is_liked', 'like', 'discount', 'reviews_avg_rating', 'reviews_count'];

    protected $fillable = [
        'vendor_id',
        'name',
        'servings',
        'quantity',
        'unit',
        'protein',
        'carbohydrates',
        'calcium',
        'calories',
        'dietary_restriction',
        'short_description',
        'long_description',
        'category',
        'image_url',
        'price',
        'units',
        'old_price',
        'slug',

        "secondary_image_url",
        "tertiary_image_url",
        "quaternary_image_url",
    ];

    public const DIETARY_RESTRICTIONS = [
        'vegetarian',
        'vegan',
        'gluten-free',
        'dairy-free',
        'nut-free',
        'kosher',
        'halal',
    ];

    public const UNITS = [
        'g',
        'kg',
        'ml',
        'l',
        'oz',
        'lb',
        'tsp',
        'tbsp',
        'cup',
        'pint',
        'quart',
        'gallon',
        'unit',
    ];

    public const CATEGORIES = [
        'cereal',
        'vegetable',
        'fish',
        'bread',
    ];


    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($name) => $name,
            set: fn ($name) => [
                'name' => $name,
                'slug' => Str::slug($name)
            ]
        );
    }

    public function getLikeAttribute(): Like | null
    {
        return $this->likes()->where('user_id', Auth::id())->get()->first();
    }
    public function getIsLikedAttribute(): bool
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }
    public function getRouteKeyName(): string
    {
        return "slug";
    }


    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function scopeHasCategory($query, $category): void
    {
        $query->where('category', $category);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function getReviewsAvgRatingAttribute(): float
    {

        return $this->load(['reviews'])->reviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute(): int
    {
        return $this->load(['reviews'])->reviews()->count() ?? 0;
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity')->as('listing');
    }


    public function getDiscountAttribute(): float | null
    {
        return $this->old_price ? ceil(($this->old_price - $this->price) / $this->old_price * 100) : null;
    }


    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($image_url) => asset($image_url),
            set: fn ($image_url) => $image_url
        );
    }


    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($price) => $price,
            set: fn ($price) => ['price' => $price, 'old_price' => $this->price ?? null]
        );
    }


}
