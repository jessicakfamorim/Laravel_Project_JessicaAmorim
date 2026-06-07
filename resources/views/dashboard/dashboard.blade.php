@extends('layouts.fo')

@section('content')

    <h2>Olá, {{ Auth::user()->name }}</h2>

    <!-- Mostra algumas estatísticas gerais da aplicação. -->
    <div class="card mb-4">
        <div class="card-body">
            <h4>Estatísticas</h4>

            <p>Total de Bandas: {{ $totalBandas }}</p>

            <p>Total de Álbuns: {{ $totalAlbuns }}</p>
        </div>
    </div>

    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
        <h5>Perfil: Administrador</h5>
        <p>Como administrador, pode criar, editar e apagar bandas e álbuns.</p>
    @else
        <h5>Perfil: Utilizador</h5>
        <p>Pode editar bandas e álbuns, mas não pode criar nem apagar registos.</p>

    @endif

@endsection
