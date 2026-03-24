<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>

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
    <!-- Botón para ir a clientes -->
    <a href="{{ url('/clientes') }}" class="btn btn-secondary mb-3">← Volver a Clientes</a>
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

        <h2 class="text-center mb-4">Productos</h2>

        <!-- 🟢 AÑADIR CLIENTE -->
        <div class="card p-4 mb-4">
            <h4>Añadir Productos</h4>

            <form method="POST" action="/productos">
                @csrf
                <input class="form-control mb-2" name="nombre" placeholder="Nombre" required>
                <input class="form-control mb-2" name="precio" placeholder="precio" required>

                <button class="btn btn-custom w-100">Guardar</button>
            </form>
        </div>

        <!-- 🔵 LISTA -->
        <div class="card p-4">
            <h4>Lista de Productos</h4>

            <table class="table table-dark mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $c)
                    <tr>
                        <td>{{ $c->nombre }}</td>
                        <td>{{ $c->precio }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="abrirModal('{{ $c->id }}','{{ $c->nombre }}','{{ $c->precio }}')">
                                Editar
                            </button>
                            <form action="/productos/{{ $c->id }}" method="POST" style="display:inline;">
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
    <!-- 🔵 MODAL EDITAR PRODUCTO -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background:#2a2b38; color:white;">

                <div class="modal-header">
                    <h5 class="modal-title">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="formEditar">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <label for="edit-nombre">Nombre:</label>
                        <input type="text" id="edit-nombre" name="nombre" class="form-control" required>

                        <label for="edit-precio">Precio:</label>
                        <input type="number" id="edit-precio" name="precio" class="form-control" step="0.01" min="0" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function abrirModal(id, nombre, precio, ) {
            document.getElementById('edit-nombre').value = nombre;
            document.getElementById('edit-precio').value = precio;

            document.getElementById('formEditar').action = "/productos/" + id;

            var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
            modal.show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>