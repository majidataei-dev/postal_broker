<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'tracking_code',
        'service_type',
        'status',
        'packages',
        'description'
    ];

    protected $casts = [
        'packages' => 'array',
    ];

    // Status constants
    public const STATUS_PENDING   = 'pending';
    public const STATUS_SHIPPED   = 'shipped';
    public const STATUS_DELIVERED = 'delivered';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_SHIPPED,
        self::STATUS_DELIVERED,
    ];

    //  helper methods to check status
    public function isValidStatus(string $type): bool
    {
        return in_array($type, self::STATUSES);
    }

    // Service type constants
    public const SERVICE_STANDARD      = 'standard';
    public const SERVICE_EXPRESS       = 'express';
    public const SERVICE_PRIORITY      = 'priority';
    public const SERVICE_INTERNATIONAL = 'international';

    public const SERVICE_TYPES = [
        self::SERVICE_STANDARD,
        self::SERVICE_EXPRESS,
        self::SERVICE_PRIORITY,
        self::SERVICE_INTERNATIONAL,
    ];

    // Helper methods for service types
    public function isValidServiceType(string $type): bool
    {
        return in_array($type, self::SERVICE_TYPES);
    }

    // Package type constant
    public const PACKAGE_DOCUMENT = 'document';
    public const PACKAGE_PARCEL = 'parcel';
    public const PACKAGE_FRAGILE = 'fragile';
    public const PACKAGE_PERISHABLE = 'perishable';
    public const PACKAGE_VALUABLE = 'valuable';

    // list of all types for validation
    public const PACKAGE_TYPES = [
        self::PACKAGE_DOCUMENT,
        self::PACKAGE_PARCEL,
        self::PACKAGE_FRAGILE,
        self::PACKAGE_PERISHABLE,
        self::PACKAGE_VALUABLE,
    ];

    public static function isValidPackageType(string $type): bool
    {
        return in_array($type, self::PACKAGE_TYPES);
    }

    // this command run before data store in data base 
    // create random unique 24 length number for tracking_code
    protected static function booted()
    {
        static::creating(function ($shipment) {
            // check tracking_code might be empty
            if (!$shipment->tracking_code) {
                $shipment->tracking_code = self::generateNumericTrackingCode();
            }
        });
    }

    // this function create 24 length number for use in $fillable
    protected static function generateNumericTrackingCode() {
        $tracking_code = '';

        for ($i=0; $i < 24; $i++) { 
            $tracking_code .= mt_rand(0, 9);
        }

        return $tracking_code;
    }

    // Releations
    // each shipment have 1 sender and receiver
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
