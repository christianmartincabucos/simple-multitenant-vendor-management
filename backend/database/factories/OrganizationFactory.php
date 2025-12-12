<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organization;

class OrganizationFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Org ' . $this->faker->randomDigit(),
        ];
    }
}
