<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Organization;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Organization::factory()->count(2)->create()->each(function($org) {
            // 2 accountants and 1 admin per org
            User::factory()->for($org)->count(2)->create();
            User::factory()->for($org)->admin()->create([
                'name' => "Admin {$org->id}",
                'email' => "admin+{$org->id}@example.com"
            ]);
            Vendor::factory()->for($org)->count(4)->create()->each(function($vendor) use ($org) {
                Invoice::factory()->for($org)->for($vendor)->count(5)->create();
            });
            $org->vendors()->count() ?: Vendor::factory()->for($org)->count(4)->create();
        });

    }
}
