<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('providers')->insert([
            [
                'name' => "Mock One",
                'status' => 1,
                'url' => 'https://raw.githubusercontent.com/WEG-Technology/mock/main/mock-two',
                'duration_variable' => 'sure',
                'difficulty_variable' => 'zorluk',
                'created_by' => 1,
                'created_at' => now()
            ],
            [
                'name' => "Mock Two",
                'status' => 1,
                'url' => 'https://raw.githubusercontent.com/WEG-Technology/mock/main/mock-one',
                'duration_variable' => 'estimated_duration',
                'difficulty_variable' => 'value',
                'created_by' => 1,
                'created_at' => now()
            ]
        ]);
    }
}
