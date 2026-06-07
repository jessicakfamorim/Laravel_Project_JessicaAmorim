<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container"> <a class="navbar-brand fw-bold" href="{{ route('homepage') }}">Bandas </a> <button
                class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBandas"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarBandas">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('homepage') }}">Início</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('homepage') }}">Bandas</a> </li>

                    @if (Route::has('login'))
                    {{-- @auth verifica se existe um utilizador autenticado. Se existir, mostra os botões Dashboard e Logout.
                    Caso contrário, são mostrados os botões Login e Registo. --}}
                        @auth
                            <li class= "nav-item me-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-info">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">Logout</button>
                                </form>
                            </li>

                        @else
                            <li class="nav-item me-2">
                                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-primary">Registo</a>
                            </li>

                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="container py-4"> @yield('content') </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
