<?php

namespace App\Services;

use App\Models\Organization;

class TenantService {
    protected ?Organization $organization = null;

    public function setOrganization(Organization $org): void {
        $this->organization = $org;
    }

    public function getOrganization(): ?Organization {
        return $this->organization;
    }

    public function getId(): ?int {
        return $this->organization?->id;
    }
}

