<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Banda;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Apresenta todos os álbuns de uma banda.
     */
    public function index($id)
    {
        // Procura e devolve a banda correspondente ao ID recebido pela rota.
        // O find() procura um registo pelo seu id.
        $banda = Banda::find($id);

        // Esta linha é praticamente o equivalente ao select/from/where do sql.
        // O get() é o que manda o Laravel executar a consulta e devolver os resultados.
        $albuns = Album::where('banda_id', $id)->get();

        return view('albuns.index', compact('banda', 'albuns'));
    }

    /**
     * Apresenta o formulário de criação de álbuns.
     */
    public function create()
    {
        // Banda::all() executa uma consulta à tabela bandas na base de dados e devolve todos os registos encontrados.
        // O resultado é guardado na variável $bandas.
        $bandas = Banda::all();

        // Devolve a view albuns.create.
        // compact('bandas') cria um array associativo e envia a variável $bandas para a view.
        //  Array associativo é um array que utiliza nomes (chaves) em vez de posições numéricas.
        return view('albuns.create', compact('bandas'));
    }

    /**
     * Guarda um novo album na base de dados.
     */

    // Request → classe do Laravel responsável por receber os dados enviados pelos formulários.
    // $request → objeto/variável que contém estes dados.
    public function store(Request $request)
    {
        // dd($request);

        // Valida os dados recebidos do formulário.
        $request->validate([
            'nome' => 'required|max:100',
            'imagem' => 'required|image',
            'data_lancamento' => 'required',
            'banda_id' => 'required',
        ]);

        // Guarda a imagem e devolve o caminho onde ficou armazenada.
        // Esse camimho fica guardado na variável $caminhoImagem para posteriormente ser inserido na base de dados.
        // $request->file('imagem') vai buscar o ficheiro enviado pelo campo imagem do formulário.
        // ->store('albuns', 'public') significa: "Guarda esse ficheiro na pasta albuns do disco public."
        $caminhoImagem = $request->file('imagem')->store('albuns', 'public');

        // Cria um novo registo na tabela albuns.
        Album::create([
            'nome' => $request->nome,
            'imagem' => $caminhoImagem,
            'data_lancamento' => $request->data_lancamento,
            'banda_id' => $request->banda_id,
        ]);
        // dd('Álbum guardado com sucesso!');

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
}
