<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// Migration define a estrutura da tabela. É utilizada para criar, alterar ou remover tabelas.
// Analogia: A Migration é o arquiteto da base de dados e o Model é o funcionário que trabalha dentro da tabela.
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bandas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandas');
    }
};
