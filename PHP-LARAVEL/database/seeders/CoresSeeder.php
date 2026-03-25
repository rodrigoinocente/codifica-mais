<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cores')->insert([
            [
                'nome' => 'Preto',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Branco',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Azul',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Vermelho',
                'is_sistema' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
