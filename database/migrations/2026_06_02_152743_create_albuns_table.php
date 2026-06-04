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
        Schema::create('albuns', function (Blueprint $table) {

            $table->id();
            $table->string('nome');
            $table->string('imagem')->nullable();
            $table->date('data_lancamento');
            // O campo abaixo cria a coluna que irá guardar o ID da banda a qual o album pertence.
            // unsignedBigInteger(), garante que o tipo de dados da chave estrangeira seja exatamente igual ao da chave primária da tabela de origem.
            $table->unsignedBigInteger('banda_id');
            $table->timestamps();

            // Criamos a chave estrangeira. Isto garante que banda_id referencia um id existente na tabela bandas.
            $table->foreign('banda_id')
              ->references('id')
              ->on('bandas')
            // Comportamento ao apagar. Se a banda for apagada, os álbuns também serao apagados automaticamente.
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albuns');
    }
};
