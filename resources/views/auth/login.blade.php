@extends('layouts.fo')

@section('content')

<h1>Login</h1>

<form method="POST" action="{{ route('login') }}">

    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <button class="btn btn-primary">Entrar</button>

</form>

@endsection
