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
        // Esta migration altera a tabela users, adicionando uma nova coluna chamada user_type.
        // Essa coluna será usada para identificar o tipo de utilizador da aplicação.
        Schema::table('users', function (Blueprint $table) {

            // Identifica o tipo de utilizador.
            // 1 = Administrador
            // 2 = Utilizador
            $table->integer('user_type')->default(2)->after('name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Remove a coluna user_type.
            $table->dropColumn('user_type');
        });
    }
};
