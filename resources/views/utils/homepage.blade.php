@extends('layouts.fo')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Bandas</h1>

        <!--
        Criei um link para a rota 'bandas.create', definida no ficheiro web.php.
        Poderia escrever diretamente: href="/bandas/create", mas utilizar a rota
        desta forma é mais seguro porque, caso altere a rota no futuro, nao será
        necessário alterar todos os links do projeto.
    -->
        <a href="{{ route('bandas.create') }}" class="btn btn-primary"> Nova Banda </a>
    </div>
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Nº Álbuns</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bandas as $banda)
                <tr>
                    <td>
                        <img src="https://placehold.co/100x100" alt="Foto da banda" class="img-thumbnail">
                    </td>
                    <td> {{ $banda->nome }} </td>
                    <td> 0 </td>
                    <td>
                        <!--
                        Envia o utilizador para a página de álbuns da banda selecionada.
                        O ID da banda é enviado como parâmetro da rota. -->
                        <a href="{{ route('albuns.index', $banda->id) }}" class="btn btn-info btn-sm"> Ver Álbuns </a>
                        <a href="#" class="btn btn-warning btn-sm"> Editar </a>
                        <a href="#" class="btn btn-danger btn-sm">Apagar </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
