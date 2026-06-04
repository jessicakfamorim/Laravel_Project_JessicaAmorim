<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandaController;
use Illuminate\Support\Facades\Route;

// Route para a página inicial do Laravel
Route::get('/', [BandaController::class, 'welcomeFunction'])->name('welcome_route_name');

// Route para a página principal das bandas
Route::get('/home', [BandaController::class, 'homepageFunction'])->name('homepage');

// **** BANDAS ****
// Route para apresentar o formulário de criação de bandas
Route::get('/bandas/create', [BandaController::class, 'create'])->name('bandas.create');

// Route que recebe os dados do formulário e os inserir na base de dados
Route::post('/bandas', [BandaController::class, 'store'])->name('bandas.store');

// **** ÁLBUNS ****
// Route para apresentar o formulário de criação de álbuns
Route::get('/albuns/create', [AlbumController::class, 'create'])->name('albuns.create');

// Route que recebe os dados do formulário e cria um novo álbum
Route::post('/albuns', [AlbumController::class, 'store'])->name('albuns.store');

// Route para apresentar os álbuns de uma banda específica
Route::get('/bandas/{id}/albuns', [AlbumController::class, 'index'])->name('albuns.index');





// Route executada quando o utilizador acede a uma página inexistente
Route::fallback([BandaController::class, 'fallbackFunction']);
