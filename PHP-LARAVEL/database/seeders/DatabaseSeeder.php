<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoriasSeeder;
use Database\Seeders\CoresSeeder;
use Database\Seeders\TamanhosSeeder;
use Database\Seeders\GenerosSeeder;
use Database\Seeders\MarcasSeeder;
use Database\Seeders\SegmentosSeeder;
use Database\Seeders\ProdutosSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriasSeeder::class,
            CoresSeeder::class,
            TamanhosSeeder::class,
            GenerosSeeder::class,
            MarcasSeeder::class,
            SegmentosSeeder::class,
        ]);

        $this->call([ProdutosSeeder::class]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
