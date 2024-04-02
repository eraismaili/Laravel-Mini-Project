<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->create([
            'name' => 'Test Company',
            'email' => 'test@example.com',
            'logo' => 'https://via.placeholder.com/100x100',
            'website' => 'https://www.example1.com',
        ]);

    }
}
