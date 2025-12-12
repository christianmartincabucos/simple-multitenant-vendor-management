<?php

use App\Models\Invoice;
use App\Models\Organization;
use App\Models\User;

test('user cannot see invoices from another organization', function () {
    $orgA = Organization::factory()->create();
    $orgB = Organization::factory()->create();

    $userA = User::factory()->create(['organization_id' => $orgA->id]);
    actingAsTenant($userA);

    $invoiceA = Invoice::factory()->create(['organization_id' => $orgA->id]);
    $invoiceB = Invoice::factory()->create(['organization_id' => $orgB->id]);

    $response = $this->getJson('/api/invoices');
    $response->assertOk()
        ->assertJsonCount(3)
        ->assertJsonFragment(['id' => $invoiceA->id])
        ->assertJsonMissing(['id' => $invoiceB->id]);
});

test('user can see all invoices from their organization', function () {
    $org = Organization::factory()->create();
    $user = User::factory()->create(['organization_id' => $org->id]);
    actingAsTenant($user);

    $invoice1 = Invoice::factory()->create(['organization_id' => $org->id]);
    $invoice2 = Invoice::factory()->create(['organization_id' => $org->id]);

    $response = $this->getJson('/api/invoices');

    $response->assertOk()
        ->assertJsonCount(3)
        ->assertJsonFragment(['id' => $invoice1->id])
        ->assertJsonFragment(['id' => $invoice2->id]);
});