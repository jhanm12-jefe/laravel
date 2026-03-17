<!DOCTYPE html>
<html>

<head>
    <title>Mi Primer Laravel</title>
</head>

<body>
    <h1>Bienvenido a Laravel</h1>
    <p>Este es un ejemplo de vista.</p>

    <h2>Encontrar el mayor de 3 números</h2>
    <form method="POST" action="/mayor">
        @csrf

        <input type="number" name="a" placeholder="Numero 1">
        <input type="number" name="b" placeholder="Numero 2">
        <input type="number" name="c" placeholder="Numero 3">

        <button type="submit">Calcular</button>

    </form>

    @if(isset($mayor))
    <h3>El número mayor es: {{ $mayor }}</h3>
    @endif
    <h2>Verificar si un número es primo</h2>

    <form method="POST" action="/primo">
        @csrf

        <input type="number" name="numero" placeholder="Ingrese número">

        <button type="submit">Verificar</button>

    </form>

    @if(isset($esPrimo))

    @if($esPrimo)
    <h3>{{ $num }} es primo</h3>
    @else
    <h3>{{ $num }} no es primo</h3>
    @endif

    @endif
</body>

</html