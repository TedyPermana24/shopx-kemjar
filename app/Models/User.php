<?php

namespace App\Models;

use App\Services\EncryptionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's name.
     *
     * @return string|null
     */
    public function getNameAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the user's name.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        if (!$value) {
            $this->attributes['name'] = null;
            return;
        }

        $encryptionService = app(EncryptionService::class);
        $this->attributes['name'] = $encryptionService->encrypt($value);
    }

    /**
     * Get the user's phone number.
     *
     * @return string|null
     */
    public function getPhoneAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the user's phone number.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        if (!$value) {
            $this->attributes['phone'] = null;
            return;
        }

        $encryptionService = app(EncryptionService::class);
        $this->attributes['phone'] = $encryptionService->encrypt($value);
    }

    /**
     * Get the user's address.
     *
     * @return string|null
     */
    public function getAddressAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the user's address.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setAddressAttribute($value)
    {
        if (!$value) {
            $this->attributes['address'] = null;
            return;
        }

        $encryptionService = app(EncryptionService::class);
        $this->attributes['address'] = $encryptionService->encrypt($value);
    }

    /**
     * Get the payment methods for the user.
     */
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
