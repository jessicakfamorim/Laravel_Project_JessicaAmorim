@extends('layouts.fo')

@section('content')
    <h1>Nova Banda</h1>

    <!--
            O method="POST" indica que vamos enviar dados para o servidor.

            action route('bandas.store') define para onde os dados serão enviados.
            Utilizamos o nome da rota em vez de escrever o URL diretamente, porque se algo for alterado no futuro,
            não haverá necessidade de alterar todos os links do caminho.
            Adicionamos o enctype="multipart/form-data" para o formulário cnoseguir enviar a imagem.-->
    <form method="POST" action="{{ route('bandas.store') }}" enctype="multipart/form-data">
        <!--
            Obrigatório em todos os formulários POST do Laravel.
            Cria um token de segurança (CSRF) para proteger
            a aplicação contra pedidos maliciosos. -->
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome da Banda</label>
            <input type="text" class="form-control" name="nome">

            <!--
            Verifica se existe algum erro de validação associado ao campo "nome".
            Se existir, apresenta a mensagem de erro gerada automaticamente pelo Laravel. -->
            @error('nome')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto">

            @error('foto')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!--
            Botão que submete o formulário do tipo "submit" para enviar todos os
            dados do formulário para a rota definida no atributo action do form. -->
        <button type="submit" class="btn btn-primary"> Guardar </button>
    </form>
@endsection
