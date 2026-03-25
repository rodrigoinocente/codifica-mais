<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nome' => 'Camisetas',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Calças',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Tênis',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Acessórios',
                'is_sistema' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
