<?php

namespace App\Http\Controllers;

use App\Models\Banda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Procura todas as bandas e ordena por nome
        // por ordem alfabética (A-Z).
        $bandas = Banda::orderBy('nome')->get();

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
        // Apenas administradores podem criar bandas.
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
            return redirect()->route('homepage');
        }

        return view('bandas.create');
    }

    /**
     * Guarda uma nova banda na base de dados.
     */

    // Request → classe do Laravel responsável por receber os dados enviados pelos formulários.
    // $request → objeto/variável que contém estes dados.
    public function store(Request $request)
    {

        // Apenas administradores podem criar bandas.
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
        return redirect()->route('homepage');
        }

        // dd($request);

        // Valida os dados recebidos do formulário.
        $request->validate([
            'nome' => 'required|max:100',
            'foto' => 'required|image',
        ]);

        // Guarda a imagem e devolve o caminho onde ficou armazenada.
        // Esse camimho fica guardado na variável $caminhoFoo para posteriormente ser inserido na base de dados.
        // $request->file('foto') vai buscar o ficheiro enviado pelo campo imagem do formulário.
        // ->store('bandas', 'public') significa: "Guarda esse ficheiro na pasta bandas do disco public."
        $caminhoFoto = $request->file('foto')->store('bandas', 'public');

        // dd($caminhoFoto);

        // Cria um novo registo na tabela bandas.
        Banda::create([
            'nome' => $request->nome,
            'foto' => $caminhoFoto,
        ]);

        // Redireciona o utilizador para a homepage.
        return redirect()->route('homepage')
        ->with('message', 'Banda criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Apresenta o formulário de edição de uma banda.
     */
    public function edit(string $id)
    {

        // Apenas utilizadores autenticados podem editar.
        if (!Auth::check()) {
        return redirect()->route('homepage');
        }

        // Procura a banda correspondente ao ID recebido pela rota.
        $banda = Banda::find($id);

        // Envia a banda para a view.
        return view('bandas.edit', compact('banda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        // Apenas utilizadores autenticados podem editar.
        if (!Auth::check()) {
        return redirect()->route('homepage');
        }

        // Procura a banda que será atualizada.
        $banda = Banda::find($request->id);

        // Atualiza o nome da banda.
        $banda->nome = $request->nome;

        // Verifica se o utilizador escolheu uma nova foto.
        // Só executa o código abaixo se o utilizador tiver escolhido uma nova foto.
        if ($request->hasFile('foto')) {

            // Guarda a nova foto e devolve o caminho.
            $caminhoFoto = $request->file('foto')->store('bandas', 'public');

            // Atualiza o caminho da foto na base de dados.
            $banda->foto = $caminhoFoto;
        }

        // Guarda as alterações na base de dados.
        $banda->save();

        // Redireciona o utilizador para a homepage.
        return redirect()->route('homepage')
        ->with('message', 'Álbum atualizado com sucesso.');
    }

    /**
     * Remove uma banda da base de dados.
     */
    public function destroy($id)
    {

        // Apenas administradores podem apagar bandas.
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
        return redirect()->route('homepage');
        }

        // Procura a banda correspondente ao ID recebido pela rota.
        $banda = Banda::find($id);

        // Apaga a banda da base de dados.
        $banda->delete();

        // Redireciona o utilizador para a homepage.
        return redirect()->route('homepage')
        ->with('message', 'Álbum excluído com sucesso.');
    }

    public function fallbackFunction()
    {
        return view('utils.fallback');
    }
}
