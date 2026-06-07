@extends('layouts.fo')

@section('content')
    <h1>Novo Álbum</h1>

        <!--
            O method="POST" indica que vamos enviar dados para o servidor.

            action route('albuns.store') define para onde os dados serão enviados.
            Utilizamos o nome da rota em vez de escrever o URL diretamente, porque se algo for alterado no futuro,
            não haverá necessidade de alterar todos os links do caminho.
            Adicionamos o enctype="multipart/form-data" para o formulário cnoseguir enviar a imagem. -->

    <form method="POST" action="{{ route('albuns.store') }}" enctype="multipart/form-data">
        <!--
            Obrigatório em todos os formulários POST do Laravel.
            Cria um token de segurança (CSRF) para proteger
            a aplicação contra pedidos maliciosos. -->
        @csrf

        <div class="mb-3">
            <label class="form-label"> Nome do Álbum </label>
            <input type="text" class="form-control" name="nome">

            @error('nome')
                <p class="text-danger">O nome do álbum é obrigatório.</p>
            @enderror
        </div>
         <div class="mb-3">
            <label class="form-label"> Imagem do Álbum </label>
            <input type="file" class="form-control" name="imagem">

            @error('imagem')
                <p class="text-danger">Deve selecionar uma imagem válida.</p>
            @enderror
        </div>

        <div class="mb-3"> <label class="form-label"> Data de Lançamento </label>
            <input type="date" class="form-control" name="data_lancamento">
            
            @error('data_lancamento')
                <p class="text-danger">A data de lançamento é obrigatória.</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"> Banda </label>
            <select class="form-select" name="banda_id">
                <option value=""> Selecione uma banda </option>

        <!--
            Percorre todas as bandas recebidas do Controller. A cada volta do ciclo,
            uma banda é guardada temporariamente na variável $banda. -->
                @foreach ($bandas as $banda)
                <!-- Cria uma opção para cada banda existente e guarda o ID da banda.  -->
                    <option value="{{ $banda->id }}">
                        <!-- Mostra o nome da banda ao utilizador -->
                        {{ $banda->nome }}
                    </option>
                @endforeach

            </select>
            @error('banda_id')
                <p class="text-danger">Deve selecionar uma banda.</p>
            @enderror
        </div>

        <button class="btn btn-primary"> Guardar </button>
    </form>
@endsection
