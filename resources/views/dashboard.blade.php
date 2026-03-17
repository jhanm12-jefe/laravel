<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h1>Bienvenido al sistema</h1>
        <h2> {{ auth()->user()->name }}</h2>
        <p>Has iniciado sesión correctamente.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Cerrar sesión</button>
        </form>

    </div>

</body>

</html>