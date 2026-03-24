@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pedidos de {{ $cliente->nombre }}</h2>

    <form action="{{ route('clientes.pedidos.store', $cliente->id) }}" method="POST">
        @csrf
        <input type="number" name="total" placeholder="Total" step="0.01" min="0" required>
        <select name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="procesado">Procesado</option>
            <option value="entregado">Entregado</option>
            <option value="cancelado">Cancelado</option>
        </select>
        <button class="btn btn-success">Agregar Pedido</button>
    </form>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->total }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>{{ $pedido->fecha_pedido }}</td>
                <td>
                    <form action="{{ route('clientes.pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-3">Volver a Clientes</a>
</div>
@endsection