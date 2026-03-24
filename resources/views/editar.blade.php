<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>

<body>

<h2>Editar Cliente</h2>

<form method="POST" action="/clientes/{{ $cliente->id }}">
    @csrf
    @method('PUT')

    <input name="nombre" value="{{ $cliente->nombre }}">
    <input name="correo" value="{{ $cliente->correo }}">
    <input name="direccion" value="{{ $cliente->direccion }}">

    <button>Actualizar</button>
</form>

</body>
</html>