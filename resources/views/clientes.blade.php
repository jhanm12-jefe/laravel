<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1f2029;
            color: #c4c3ca;
        }

        .card {
            background-color: #2a2b38;
        }

        .btn-custom {
            background-color: #ffeba7;
            color: #102770;
            font-weight: bold;
        }

        /* 🔥 BOTÓN HOVER ARREGLADO */
        .btn-custom:hover {
            background-color: #ffeba7;
            color: #000;
        }

        /* 🔥 TITULOS VISIBLES */
        h2,
        h4 {
            color: #ffeba7;
        }

        /* 🔥 LOGOUT FIJO */
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }

        .border {
            background-color: #1f2029;
            color: #fff;
            border: 1px solid #ffeba7 !important;
        }

        /* 🔥 ALERTA */
        #alerta {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
            width: 300px;
        }
    </style>
</head>

<body>

    <!-- 🔍 BUSCAR CLIENTE -->
    <div class="card p-4 mb-4">
        <h4>Buscar Cliente</h4>
        @if ($errors->any())
        <div class="alert alert-danger text-center">
            {{ $errors->first() }}
        </div>
        @endif
        <form method="GET" action="/clientes/buscar">

            <div class="row justify-content-center">

                <div class="col-md-3">
                    <input type="text" name="nombre" class="form-control mb-2"
                        placeholder="Nombre"
                        value="{{ request('nombre') }}">
                </div>

                <div class="col-md-3">
                    <input type="text" name="correo" class="form-control mb-2"
                        placeholder="Correo"
                        value="{{ request('correo') }}">
                </div>
                @error('correo')
                <div class="text-danger text-center">
                    {{ $message }}
                </div>
                @enderror

                <div class="col-md-3">
                    <input type="text" name="direccion" class="form-control mb-2"
                        placeholder="Dirección"
                        value="{{ request('direccion') }}">
                </div>

            </div>

            <div class="text-center">
                <button class="btn btn-custom mt-2 px-4">Buscar</button>
            </div>

        </form>
    </div>
    @if(request()->has('nombre') || request()->has('correo') || request()->has('direccion'))
    <div class="card p-4 mb-4">

        <div class="d-flex justify-content-between">
            <h4>Resultados</h4>
            <!-- 🔄 BOTÓN REFRESH -->
            <a href="/clientes" class="btn btn-secondary btn-sm">
                🔄 Volver
            </a>
        </div>

        @if(count($clientes) > 0)

        @foreach($clientes as $c)
        <div class="border p-2 mb-2 rounded text-white">

            <strong>{{ $c->nombre }}</strong><br>
            {{ $c->correo }}<br>
            {{ $c->direccion }}

            <!-- 🔥 BOTONES -->
            <div class="mt-2">
                <button class="btn btn-warning btn-sm"
                    onclick="abrirModal('{{ $c->id }}','{{ $c->nombre }}','{{ $c->correo }}','{{ $c->direccion }}')">
                    Editar
                </button>

                <form action="/clientes/{{ $c->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>

        </div>
        @endforeach

        @else
        <div class="alert alert-warning text-center">
            No se encontraron clientes
        </div>
        @endif

    </div>

    @endif

    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('productos.index') }}" class="btn btn-success">
            📦 Ver Productos
        </a>
    </div>
    <!-- 🔴 LOGOUT FIJO -->
    <form method="POST" action="/logout" class="logout-btn">
        @csrf
        <button class="btn btn-danger">Cerrar sesión</button>
    </form>

    <!-- ✅ ALERTA -->
    @if(session('success'))
    <div id="alerta" class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <div class="container mt-5">

        <h2 class="text-center mb-4">Clientes</h2>
        @if(!request('buscar'))
        <!-- 🟢 AÑADIR CLIENTE -->
        <div class="card p-4 mb-4">
            <h4>Añadir Cliente</h4>

            <form method="POST" action="/clientes">
                @csrf
                <input class="form-control mb-2" name="nombre" placeholder="Nombre" required>
                <input class="form-control mb-2" name="correo" placeholder="Correo" required>
                <input class="form-control mb-2" name="direccion" placeholder="Dirección" required>

                <button class="btn btn-custom w-100">Guardar</button>
            </form>
        </div>

        <!-- 🔵 LISTA -->
        <div class="card p-4">
            <h4>Lista de Clientes</h4>

            <table class="table table-dark mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $c)
                    <tr>
                        <td>{{ $c->nombre }}</td>
                        <td>{{ $c->correo }}</td>
                        <td>{{ $c->direccion }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="abrirModal('{{ $c->id }}','{{ $c->nombre }}','{{ $c->correo }}','{{ $c->direccion }}')">
                                Editar
                            </button>
                            <form action="/clientes/{{ $c->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endif
    <!-- 🔥 SCRIPT ALERTA -->
    <script>
        setTimeout(() => {
            let alerta = document.getElementById('alerta');
            if (alerta) {
                alerta.style.transition = "opacity 0.5s";
                alerta.style.opacity = "0";
                setTimeout(() => alerta.remove(), 500);
            }
        }, 2000);
    </script>
    <!-- 🔵 MODAL EDITAR -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background:#2a2b38; color:white;">

                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="formEditar">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <input type="text" name="nombre" id="edit-nombre" class="form-control mb-2">
                        <input type="email" name="correo" id="edit-correo" class="form-control mb-2">
                        <input type="text" name="direccion" id="edit-direccion" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-custom">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function abrirModal(id, nombre, correo, direccion) {
            document.getElementById('edit-nombre').value = nombre;
            document.getElementById('edit-correo').value = correo;
            document.getElementById('edit-direccion').value = direccion;

            document.getElementById('formEditar').action = "/clientes/" + id;

            var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
            modal.show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>