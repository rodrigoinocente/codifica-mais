<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SegmentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('segmentos')->insert([
            [
                'nome' => 'Esportivo',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Casual',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Social',
                'is_sistema' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
