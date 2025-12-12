<?php

use App\Models\Vendor;
use App\Models\Organization;
use App\Services\TenantService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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
