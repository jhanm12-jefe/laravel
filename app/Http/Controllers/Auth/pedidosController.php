<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index($cliente_id)
    {
        $cliente = Cliente::findOrFail($cliente_id);
        $pedidos = $cliente->pedidos;
        return view('pedidos.index', compact('cliente', 'pedidos'));
    }

    public function store(Request $request, $cliente_id)
    {
        $request->validate([
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,procesado,entregado,cancelado'
        ]);

        Pedido::create([
            'cliente_id' => $cliente_id,
            'total' => $request->total,
            'estado' => $request->estado
        ]);

        return back()->with('success', 'Pedido creado');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return back()->with('success', 'Pedido eliminado');
    }
}