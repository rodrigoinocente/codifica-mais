<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TamanhosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tamanhos')->insert([
            [
                'nome' => 'P',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'M',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'G',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'GG',
                'is_sistema' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
