<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasConnectedAccounts;
    use HasFactory;
    use HasProfilePhoto {
        HasProfilePhoto::profilePhotoUrl as getPhotoUrl;
    }
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password', 'role',
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'name',

    ];

    public function canAccessPanel(Panel $panel): bool
    {
        // return $this->isAdmin();
        return true;
    }

    // public function getRoleAttribute(): string
    // {
    //     if ($this->isCustomer()) {
    //         return 'customer';
    //     }
    //     if ($this->isVendor()) {
    //         return 'vendor';
    //     }
    //     if ($this->isDeliveryPerson()) {
    //         return 'delivery_person';
    //     }
    //     if ($this->isAdmin()) {
    //         return 'admin';
    //     }
    //     return 'guest';
    // }
    /**
     * Get the URL to the user's profile photo.
     */
    public function profilePhotoUrl(): Attribute
    {
        return filter_var($this->profile_photo_path, FILTER_VALIDATE_URL)
            ? Attribute::get(fn () => $this->profile_photo_path)
            : $this->getPhotoUrl();
    }


    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . ' ' . $this->last_name,
            set: fn ($value) => [
                'first_name' => explode(' ', $value)[0],
                'last_name' => explode(' ', $value)[1],
            ]
        );
    }

    public function isCustomer(): bool
    {
        return $this->customer()->exists();
    }

    public function isVendor(): bool
    {
        return $this->vendor()->exists();
    }

    public function isDeliveryPerson(): bool
    {
        return $this->deliveryPerson()->exists();
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }



    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function deliveryPerson(): HasOne
    {
        return $this->hasOne(DeliveryPerson::class);
    }
    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class);
    }

    // public function notifications(): HasMany
    // {
    //     return $this->hasMany(Databas::class);
    // }
}
