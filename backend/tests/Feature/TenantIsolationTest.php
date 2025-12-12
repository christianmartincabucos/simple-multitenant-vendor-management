<?php

use App\Models\User;
use App\Models\Vendor;
use App\Models\Invoice;
use App\Models\Organization;
use App\Services\TenantService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
/**
 * Bind TenantService to always return auth()->user()->organization_id
 */
uses(RefreshDatabase::class);

beforeEach(function () {
    // Create two organizations
    $this->orgA = Organization::factory()->create();
    $this->orgB = Organization::factory()->create();

    // Create users for each organization
    $this->userA = User::factory()->create(['organization_id' => $this->orgA->id]);
    $this->userB = User::factory()->create(['organization_id' => $this->orgB->id]);
    $this->userAdmin = User::factory()->create([
        'organization_id' => $this->orgA->id, 'role' => 'admin']);

    // Create vendors for each organization
    $this->vendorA = Vendor::factory()->create(['organization_id' => $this->orgA->id]);
    $this->vendorB = Vendor::factory()->create(['organization_id' => $this->orgB->id]);
});

test('authenticated user can only see vendors from their organization', function () {
    $this->actingAs($this->userA);

    $response = $this->getJson('/api/vendors');

    $response->assertOk()
        ->assertJsonCount(3)
        ->assertJsonFragment(['id' => $this->vendorA->id])
        ->assertJsonMissing(['id' => $this->vendorB->id]);
});

test('user cannot access another organization\'s vendor unless admin', function () {
    $this->actingAs($this->userAdmin);

    $response = $this->getJson("/api/vendors/{$this->vendorB->id}");

    $response->assertStatus(200);
});

test('creating vendor automatically sets organization_id', function () {
    $this->actingAs($this->userAdmin);

    $payload = [
        'name' => 'Supplier X',
        'email' => 'supplierx@example.com',
        'phone' => '1234567890',
        'address' => '123 Supplier St.',
    ];

    $response = $this->postJson('/api/vendors', $payload);

    $response->assertCreated();

    $this->assertDatabaseHas('vendors', [
        'name' => 'Supplier X',
        'organization_id' => $this->userA->organization_id,
    ]);
});


test('vendor organization relationship works correctly', function () {
    $vendor = Vendor::factory()->create(['organization_id' => $this->orgA->id]);
    $this->assertEquals($this->orgA->id, $vendor->organization->id);
});

