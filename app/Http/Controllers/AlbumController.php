<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Banda;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

         // Apenas administradores podem criar álbuns.
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
            return redirect()->route('homepage');
        }

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

        // Apenas administradores podem criar álbuns.
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
            return redirect()->route('homepage');
        }

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
        return redirect()->route('homepage')
        ->with('message', 'Álbum criado com sucesso.');
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
    public function edit($id)
    {

        // Apenas utilizadores autenticados podem editar.
        if (!Auth::check()) {
            return redirect()->route('homepage');
        }

        // Procura o álbum correspondente ao ID recebido pela rota.
        $album = Album::find($id);

        // Obtém todas as bandas para preencher a lista de seleção.
        $bandas = Banda::all();

        // Envia o álbum e as bandas para a view.
        return view('albuns.edit', compact('album', 'bandas'));
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

        // Valida os dados recebidos do formulário.
        $request->validate([
            'nome' => 'required|max:100',
            'data_lancamento' => 'required',
            'banda_id' => 'required',
        ]);

        // Procura o álbum que será atualizado.
        $album = Album::find($request->id);

        // Atualiza o nome do álbum.
        $album->nome = $request->nome;

        // Atualiza a data de lançamento.
        $album->data_lancamento = $request->data_lancamento;

        // Atualiza a banda associada ao álbum.
        $album->banda_id = $request->banda_id;

        // Verifica se o utilizador escolheu uma nova imagem.
        // Só executa o código abaixo se o utilizador tiver escolhido uma nova imagem.
        if ($request->hasFile('imagem')) {

            // Guarda a nova imagem e devolve o caminho.
            $caminhoImagem = $request->file('imagem')->store('albuns', 'public');

            // Atualiza o caminho da imagem na base de dados.
            $album->imagem = $caminhoImagem;
        }

        // Guarda as alterações na base de dados.
        $album->save();

        // Redireciona o utilizador para a página dos álbuns da banda.
        return redirect()->route('albuns.index', $album->banda_id)
        ->with('message', 'Álbum atualizado com sucesso.');
    }

    /**
     * Remove um álbum da base de dados.
     */
    public function destroy($id)
    {

        // Apenas administradores podem apagar álbuns.
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
            return redirect()->route('homepage');
        }

        // Procura o álbum correspondente ao ID recebido pela rota.
        $album = Album::find($id);

        // Guarda o ID da banda antes de apagar o álbum.
        $bandaId = $album->banda_id;

        // Remove o álbum da base de dados.
        $album->delete();

        // Redireciona o utilizador para a lista de álbuns da banda.
        return redirect()->route('albuns.index', $bandaId)
        ->with('message', 'Álbum excluído com sucesso.');
    }
}
