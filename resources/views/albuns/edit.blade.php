@extends('layouts.fo')

@section('content')
    <h1>Editar Álbum</h1>

    <!--
        O method="POST" indica que vamos enviar dados para o servidor.

        action route('albuns.store') define para onde os dados serão enviados.
        Utilizamos o nome da rota em vez de escrever o URL diretamente, porque se algo for alterado no futuro,
        não haverá necessidade de alterar todos os links do caminho.
        Adicionamos o enctype="multipart/form-data" para o formulário cnoseguir enviar a imagem. -->

    <form method="POST" action="{{ route('albuns.update') }}" enctype="multipart/form-data">
        <!--
            Obrigatório em todos os formulários POST do Laravel.
            Cria um token de segurança (CSRF) para proteger
            a aplicação contra pedidos maliciosos. -->
        @csrf
        @method('PUT')
        <!--
            Campo oculto que guarda o ID do álbum. Este valor será enviado para o Controller para
            identficar qual álbm deve ser atualizado -->
        <input type="hidden" name="id" value="{{ $album->id }}">

        <div class="mb-3">
            <label class="form-label"> Nome do Álbum </label>
            <input type="text" class="form-control" name="nome" value="{{ $album->nome }}">
        </div>
        <div class="mb-3">
            <img src="{{ asset('storage/' . $album->imagem) }}" width="150" class="img-thumbnail mb-3"
                alt="Imagem atual do álbum">
            <label class="form-label"> Imagem do Álbum </label>
            <input type="file" class="form-control" name="imagem">
        </div>

        <div class="mb-3"> <label class="form-label"> Data de Lançamento </label>
            <input type="date" class="form-control" name="data_lancamento" value="{{ $album->data_lancamento }}">
        </div>

        <div class="mb-3">
            <label class="form-label"> Banda </label>
            <select class="form-select" name="banda_id">
                <option value=""> Selecione uma banda </option>

                <!--
                    Percorre todas as bandas recebidas do Controller. A cada volta do ciclo,
                    uma banda é guardada temporariamente na variável $banda. -->
                @foreach ($bandas as $banda)

                    <!-- Esse código compara o valor da chave estrangeira do álbum (banda_id) com o ID de cada banda que está a ser percorrida no foreach.
                        Quando encontra uma banda cujo ID é igual ao banda_id do álbum, adiciona o atributo selected àquela opção do <select>. -->
                    <option value="{{ $banda->id }}" {{ $album->banda_id == $banda->id ? 'selected' : '' }}>

                        <!-- Mostra o nome da banda ao utilizador -->
                        {{ $banda->nome }}
                    </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-primary"> Atualizar </button>
    </form>
@endsection
