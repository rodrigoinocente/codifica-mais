<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generos')->insert([
            [
                'nome' => 'Masculino',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Feminino',
                'is_sistema' => true,
                'created_at' => now(),
            ],
            [
                'nome' => 'Unissex',
                'is_sistema' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
