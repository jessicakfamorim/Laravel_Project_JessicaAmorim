@extends('layouts.fo')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Álbuns da Banda: {{ $banda->nome }} </h2>

        @auth
            {{-- Apenas administradores podem criar novos álbuns.
            Utilizadores normais e visitantes apenas podem visualizar os registos. --}}
            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                <a href="{{ route('albuns.create') }}" class="btn btn-primary"> Novo Álbum </a>
            @endif
        @endauth
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Imagem</th>
                <th>Data de Lançamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($albuns as $album)
                <tr>
                    <td>{{ $album->nome }}</td>
                    <td>
                        <!--
                        Exibe a imagem guardada para o álbum. asset('storage/...') cria o caminho público para o ficheiro.
                        $album->imagem contém o caminho da imagem guardado na base de dados. -->
                        <img src="{{ asset('storage/' . $album->imagem) }}" width="100" class="img-thumbnail" alt="Imagem do álbum">
                    </td>
                    <td>{{ $album->data_lancamento }}</td>
                    <!--
                        O ID do álbum é enviado para a rota para que o Controller saiba qual álbum deve ser editado. -->
                    <td>

                    @auth
                        <a href="{{ route('albuns.edit', $album->id) }}" class="btn btn-warning btn-sm"> Editar </a>
                    @endauth

                    @auth
                        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                            <a href="{{ route('albuns.delete', $album->id) }}" class="btn btn-danger btn-sm"> Apagar </a>
                        @endif
                    @endauth

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
