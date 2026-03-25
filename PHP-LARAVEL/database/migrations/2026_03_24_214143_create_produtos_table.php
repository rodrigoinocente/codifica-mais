<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('cor_id')->constrained('cores');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('tamanho_id')->constrained('tamanhos');
            $table->foreignId('genero_id')->constrained('generos');
            $table->foreignId('segmento_id')->constrained('segmentos');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->integer('quantidade')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
