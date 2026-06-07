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
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmar Password</label>
        <input type="password" class="form-control" name="password_confirmation">
    </div>

    <button class="btn btn-primary">Registar</button>

</form>

@endsection
