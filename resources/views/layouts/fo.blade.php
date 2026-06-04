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
        <div class="container"> <a class="navbar-brand fw-bold" href="/">Bandas </a> <button
                class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBandas"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarBandas">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"> <a class="nav-link" href="">Início</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="">Bandas</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="">Álbuns</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="">Dashboard</a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container py-4"> @yield('content') </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

{{-- !!!!!!!!!usar as diretivas @auth e @guest para mostrar o link do Dashboard apenas a quem estiver ligado --}}
