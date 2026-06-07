<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandaController;
use App\Http\Controllers\DashboardController;
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

// Route que recebe os dados da edição da banda
Route::put('/update-banda', [BandaController::class, 'update'])->name('bandas.update');

// Route para apresentar o formulário de edição da banda.
// Nesta rota utilizo {id} para identificar qual banda deve ser editada. Quando o utilizador clica no botão "Editar",
// o ID da banda é enviado diretamente na URL, por exemplo: /edit-banda/3. Desta forma, o Controller consegue saber
// imediatamente qual registo deve procurar na base de dados. Outra possibilidade seria utilizar um campo
// hidden para enviar o ID através de um formulário, mas neste caso optei por usar {id} porque a rota fica mais simples
// de ler e torna evidente qual banda está a ser editada.
Route::get('/edit-banda/{id}', [BandaController::class, 'edit'])->name('bandas.edit');

// Route para apagar uma banda
Route::get('/delete-banda/{id}', [BandaController::class, 'destroy'])->name('bandas.delete');

// **** ÁLBUNS ****

// Route para apresentar o formulário de criação de álbuns
Route::get('/albuns/create', [AlbumController::class, 'create'])->name('albuns.create');

// Route que recebe os dados do formulário e cria um novo álbum
Route::post('/albuns', [AlbumController::class, 'store'])->name('albuns.store');

// Route para apresentar os álbuns de uma banda específica
Route::get('/bandas/{id}/albuns', [AlbumController::class, 'index'])->name('albuns.index');

// Route para apresentar o formulário de edição de um álbum
Route::get('/edit-album/{id}', [AlbumController::class, 'edit'])->name('albuns.edit');

// Route que recebe os dados da edição do álbum
Route::put('/update-album', [AlbumController::class, 'update'])->name('albuns.update');

// Route para apagar um álbum
Route::get('/delete-album/{id}', [AlbumController::class, 'destroy'])->name('albuns.delete');

// **** ÁLBUNS ****

// Dashboard acessível apenas por utilizadores autenticados.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')
// O middleware auth verifica se existe um utilizador autenticado.
    ->middleware('auth');


// Route executada quando o utilizador acede a uma página inexistente
Route::fallback([BandaController::class, 'fallbackFunction']);
