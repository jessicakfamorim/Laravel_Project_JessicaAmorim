@extends('layouts.fo')

@section('content')

<h1>Registo</h1>

<form method="POST" action="{{ route('register') }}">

    {{-- Obrigatório em todos os formulários POST do Laravel.
    Cria um token de segurança (CSRF) para proteger
    a aplicação contra pedidos maliciosos. --}}
    @csrf

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="name">

        @error('name')
            <p class="text-danger">Nome inválido ou inexistente.</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email">

        @error('email')
            <p class="text-danger">Email inválido ou já registado.</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">

        @error('password')
            <p class="text-danger">Password inválida.</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmar Password</label>
        <input type="password" class="form-control" name="password_confirmation">
        
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <button class="btn btn-primary">Registar</button>

</form>

@endsection
