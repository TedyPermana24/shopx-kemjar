<?php

namespace App\Models;

use App\Services\EncryptionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_number',
        'card_holder',
        'expiry_date',
        'cvv',
        'is_default',
    ];

    /**
     * Get the user that owns the payment method.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the encrypted card number attribute.
     */
    public function getCardNumberAttribute($value)
    {
        if (!$value) return null;
        
        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the encrypted card number attribute.
     */
    public function setCardNumberAttribute($value)
    {
        if (!$value) {
            $this->attributes['card_number'] = null;
            return;
        }
        
        $encryptionService = app(EncryptionService::class);
        $this->attributes['card_number'] = $encryptionService->encrypt($value);
    }

    /**
     * Get the encrypted card holder attribute.
     */
    public function getCardHolderAttribute($value)
    {
        if (!$value) return null;
        
        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the encrypted card holder attribute.
     */
    public function setCardHolderAttribute($value)
    {
        if (!$value) {
            $this->attributes['card_holder'] = null;
            return;
        }
        
        $encryptionService = app(EncryptionService::class);
        $this->attributes['card_holder'] = $encryptionService->encrypt($value);
    }

    /**
     * Get the encrypted expiry date attribute.
     */
    public function getExpiryDateAttribute($value)
    {
        if (!$value) return null;
        
        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the encrypted expiry date attribute.
     */
    public function setExpiryDateAttribute($value)
    {
        if (!$value) {
            $this->attributes['expiry_date'] = null;
            return;
        }
        
        $encryptionService = app(EncryptionService::class);
        $this->attributes['expiry_date'] = $encryptionService->encrypt($value);
    }

    /**
     * Get the encrypted CVV attribute.
     */
    public function getCvvAttribute($value)
    {
        if (!$value) return null;
        
        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decrypt($value);
    }

    /**
     * Set the encrypted CVV attribute.
     */
    public function setCvvAttribute($value)
    {
        if (!$value) {
            $this->attributes['cvv'] = null;
            return;
        }
        
        $encryptionService = app(EncryptionService::class);
        $this->attributes['cvv'] = $encryptionService->encrypt($value);
    }
}