<?php

namespace App\Traits;

use App\Models\Organization;
use App\Services\TenantService;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToOrganization {
    public static function bootBelongsToOrganization()
    {
        static::addGlobalScope('organization', function (Builder $builder) {
            $tenantId = app(TenantService::class)->getId();
            if ($tenantId) {
                $builder->where($builder->qualifyColumn('organization_id'), $tenantId);
            }
        });
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}
