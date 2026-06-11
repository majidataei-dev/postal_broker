<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    // Primary key is UUID, not auto-incrementing
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Attributes that are mass assignable
     */
    protected $fillable = [
        'full_name',
        'mobile',
        'address',
        'zip_code'
    ];

    /**
     * Automatically generate UUID when creating a new user
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Shipments where this user is the sender
     *
     * @return HasMany
     */
    public function senderShipments(): HasMany
    {
        return $this->hasMany(Shipment::class, 'sender_id');
    }

    /**
     * Shipments where this user is the receiver
     *
     * @return HasMany
     */
    public function receiverShipments(): HasMany
    {
        return $this->hasMany(Shipment::class, 'receiver_id');
    }
}
