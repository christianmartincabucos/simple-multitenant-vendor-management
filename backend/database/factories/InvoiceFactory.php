<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => OrganizationFactory::new(),
            'vendor_id' => VendorFactory::new(),
            'amount' => $this->faker->randomFloat(2, 10, 10000),
            'status' => 'draft',
        ];
    }
}
