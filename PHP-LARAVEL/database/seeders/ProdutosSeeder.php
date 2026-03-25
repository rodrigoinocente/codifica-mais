<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produtos')->insert([
            [
                'marca_id' => 1,
                'cor_id' => 1,
                'categoria_id' => 1,
                'tamanho_id' => 2,
                'genero_id' => 3,
                'segmento_id' => 2,
                'nome' => 'Camiseta',
                'descricao' => 'Camiseta confortável para uso diário',
                'quantidade' => 10,
                'created_at' => now(),
            ],
            [
                'marca_id' => 2,
                'cor_id' => 3,
                'categoria_id' => 3,
                'tamanho_id' => 3,
                'genero_id' => 1,
                'segmento_id' => 1,
                'nome' => 'Tênis',
                'descricao' => 'Ideal para corrida',
                'quantidade' => 5,
                'created_at' => now(),
            ],
            [
                'marca_id' => 1,
                'cor_id' => 1,
                'categoria_id' => 1,
                'tamanho_id' => 2,
                'genero_id' => 3,
                'segmento_id' => 2,
                'nome' => 'Camiseta',
                'descricao' => 'Camiseta confortável para uso diário',
                'quantidade' => 10,
                'created_at' => now(),
            ],
            [
                'marca_id' => 1,
                'cor_id' => 2,
                'categoria_id' => 2,
                'tamanho_id' => 1,
                'genero_id' => 2,
                'segmento_id' => 2,
                'nome' => 'Boné',
                'descricao' => 'Ideal para corrida',
                'quantidade' => 50,
                'created_at' => now(),
            ],
        ]);
    }
}
