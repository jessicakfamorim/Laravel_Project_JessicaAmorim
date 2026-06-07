<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banda;
use App\Models\Album;

class DashboardController extends Controller
{
    // Apresenta a página Dashbaord
     public function index()
    {
        // Conta quantas bandas existem na base de dados.
        $totalBandas = Banda::count();

        // Conta quantos álbuns existem na base de dados.
        $totalAlbuns = Album::count();

        // Envia os totais para a view.
        return view('dashboard.dashboard', compact('totalBandas', 'totalAlbuns'));
    }
}
