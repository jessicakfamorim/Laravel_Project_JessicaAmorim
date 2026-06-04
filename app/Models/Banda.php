<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banda extends Model
{
    // $fillable é uma lista dos campos que o Laravel permite preencher.
    // Permite que o utilizador preencha nome e foto.
    protected $fillable = [
    'nome',
    'foto',
    ];
}


// O Model representa uma tabela da base de dados. É utilizado para inserir, consultar, atualizar e apagar registos.
// O Model funciona como uma "ponte" entre o PHP e a tabela bandas.
// Analogia: A Migration é o arquiteto da base de dados e o Model é o funcionário que trabalha dentro da tabela.
