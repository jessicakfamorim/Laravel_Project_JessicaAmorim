<?php

namespace App\Http\Controllers;

use App\Models\Banda;
use Illuminate\Http\Request;

class BandaController extends Controller
{
    // Função para a rota '/'
    public function welcomeFunction()
    {
        return view('welcome'); // Retorna a view inicial do Laravel.
    }

    // Função para a rota '/home' (Página principal das bandas)
    public function homepageFunction()
    {
        $bandas = Banda::all();

        return view('utils.homepage', compact('bandas'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bandas.create');
    }

    /**
     * Guarda uma nova banda na base de dados.
     */

        // Request → classe do Laravel responsável por receber os dados enviados pelos formulários.
        // $request → objeto/variável que contém estes dados.
    public function store(Request $request)
    {
        //dd($request);
        
        // Valida os dados recebidos do formulário.
        $request->validate([
            'nome' => 'required|max:100'
        ]);

        // Cria um novo registo na tabela bandas.
        Banda::create([
            'nome' => $request->nome,
        ]);

        // Redireciona o utilizador para a homepage.
        return redirect()->route('homepage');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fallbackFunction()
    {
        return view('utils.fallback');
    }
}
