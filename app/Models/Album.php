<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    // Como a tabela se chama "albuns" e não "albums",
    // informamos explicitamente ao Laravel qual tabela utilizar.
    protected $table = 'albuns';

    // $fillable é uma lista dos campos que o Laravel permite preencher.
    // Define os campos que o Laravel permite preencher ao criar ou atualizar um álbum.
    protected $fillable = [
        'nome',
        'imagem',
        'data_lancamento',
        'banda_id',
    ];
}
