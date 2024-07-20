<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolYear::create([
            'early_year' => '2022',
            'final_year' => '2023',
            'semester' => true, // ganjil (1)
            'active' => false
        ]);

        SchoolYear::create([
            'early_year' => '2022',
            'final_year' => '2023',
            'semester' => false, // genap (0)
            'active' => true
        ]);
    }
}
