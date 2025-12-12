<?php

namespace App\Models;

use App\Traits\BelongsToOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory, BelongsToOrganization;

    protected $fillable = [
        'organization_id',
        'name',
        'email',
        'phone',
        'address',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically set organization_id on creation
        static::creating(function ($vendor) {
            if (auth()->check() && auth()->user()->organization_id) {
                $vendor->organization_id = auth()->user()->organization_id;
            }
        });
    }
}
