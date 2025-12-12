<?php

namespace App\Models;

use App\Traits\BelongsToOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, BelongsToOrganization;

    protected $fillable = ['organization_id', 'vendor_id', 'amount', 'status'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
