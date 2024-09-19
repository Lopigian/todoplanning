<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('developers')->insert([
            [
                'name' => "Dev1",
                'capacity' => 1,
                'created_at' => now()
            ],
            [
                'name' => "Dev2",
                'capacity' => 2,
                'created_at' => now()
            ],
            [
                'name' => "Dev3",
                'capacity' => 3,
                'created_at' => now()
            ],
            [
                'name' => "Dev4",
                'capacity' => 4,
                'created_at' => now()
            ],
            [
                'name' => "Dev5",
                'capacity' => 5,
                'created_at' => now()
            ]
        ]);
    }
}
