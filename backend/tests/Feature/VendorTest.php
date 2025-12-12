<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Vendor;
use App\Services\TenantService;

beforeEach(function () {
    $this->orgA = Organization::factory()->create();
    $this->orgB = Organization::factory()->create();

    $this->userA = User::factory()->create(['organization_id' => $this->orgA->id]);
    $this->userB = User::factory()->create(['organization_id' => $this->orgB->id]);
});

test('vendor organization relationship works correctly', function () {
    $vendor = Vendor::factory()->create(['organization_id' => $this->orgA->id]);
    $this->assertEquals($this->orgA->id, $vendor->organization->id);
});

test('vendor model applies tenant global scope', function () {

    // Create two organizations
    $orgA = Organization::factory()->create();
    $orgB = Organization::factory()->create();

    // Create vendors for each organization
    $vendorA = Vendor::factory()->create(['organization_id' => $orgA->id]);
    Vendor::factory()->create(['organization_id' => $orgB->id]);

    // Fake tenant service returning organization A
    app()->bind(TenantService::class, function () use ($orgA) {
        return new class($orgA) {
            public function __construct(private $org) {}
            public function getId() { return $this->org->id; }
        };
    });

    // Should only return vendor for orgA
    $vendors = Vendor::all();

    expect($vendors->count())->toBe(1);
    expect($vendors->first()->id)->toBe($vendorA->id);
});