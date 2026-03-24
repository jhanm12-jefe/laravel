<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required'
        ]);

        Cliente::create($request->all());

        return back()->with('success', 'Cliente añadido');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('editar', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect('/clientes')->with('success', 'Cliente actualizado');
    }
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete(); // 👈 ya no elimina, solo oculta

        return redirect('/clientes')->with('success', 'Cliente eliminado');
    }

    public function buscar(Request $request)
{
    $clientes = Cliente::query();

    if ($request->nombre) {
        $clientes->where('nombre', 'like', '%' . $request->nombre . '%');
    }

     if ($request->correo) {

        if (filter_var($request->correo, FILTER_VALIDATE_EMAIL)) {
            // ✅ correo válido → búsqueda exacta
            $clientes->where('correo', $request->correo);
        } else {
            // ❌ no hacer búsqueda si no es correo válido
            return back()->withErrors(['correo' => 'Ingrese un correo válido']);
        }
    }

    if ($request->direccion) {
        $clientes->where('direccion', 'like', '%' . $request->direccion . '%');
    }

    $clientes = $clientes->get();

    return view('clientes', compact('clientes'));
}
}
