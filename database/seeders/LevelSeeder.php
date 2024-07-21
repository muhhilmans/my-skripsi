<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'name' => 'A',
            'class' => '4'
        ]);

        Level::create([
            'name' => 'B',
            'class' => '7'
        ]);

        Level::create([
            'name' => 'C',
            'class' => '10'
        ]);
    }
}