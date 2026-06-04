@extends('layouts.fo')

@section('content')
<h1>Editar Banda</h1>
    <!--
            O method="POST" indica que vamos enviar dados para o servidor.

            action route('bandas.store') define para onde os dados serão enviados.
            Utilizamos o nome da rota em vez de escrever o URL diretamente, porque se algo for alterado no futuro,
            não haverá necessidade de alterar todos os links do caminho.
            Adicionamos o enctype="multipart/form-data" para o formulário cnoseguir enviar a imagem.-->
    <form method="POST" action="{{ route('bandas.update') }}" enctype="multipart/form-data">
        <!--
            Obrigatório em todos os formulários POST do Laravel.
            Cria um token de segurança (CSRF) para proteger
            a aplicação contra pedidos maliciosos. -->
        @csrf
        <!--
            Indica ao Laravel que este formulário vai editar uma banda existente. -->
        @method('PUT')
        <!--
            Campo oculto que guarda o ID da banda. Este valor será enviado para
            o Controller para identificar qual banda deve ser atualizada. -->
        <input type="hidden" name="id" value="{{ $banda->id }}">

        <div class="mb-3">
            <label class="form-label">Nome da Banda</label>
            <input type="text" class="form-control" name="nome" value="{{ $banda->nome }}">

            <!--
            Verifica se existe algum erro de validação associado ao campo "nome".
            Se existir, apresenta a mensagem de erro gerada automaticamente pelo Laravel. -->
            @error('nome')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto">
        </div>

        <!--
            Botão que submete o formulário do tipo "submit" para enviar todos os
            dados do formulário para a rota definida no atributo action do form. -->
        <button type="submit" class="btn btn-primary"> Atualizar </button>
    </form>


@endsection
