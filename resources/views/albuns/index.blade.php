@extends('layouts.fo')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Álbuns da Banda: {{ $banda->nome }} </h2>
        <a href="{{ route('albuns.create') }}" class="btn btn-primary"> Novo Álbum </a>
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
                    <td> <a href="#" class="btn btn-warning btn-sm"> Editar </a>
                        <a href="#" class="btn btn-danger btn-sm"> Apagar </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
