<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        return view('productos', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'previo' => 'required'
            
        ]);

        Productos::create($request->all());

        return back()->with('success', 'Producto añadido');
    }

    public function edit($id)
    {
        $productos = Productos::findOrFail($id);
        return view('editar', compact('productos'));
    }

    public function update(Request $request, $id)
    {
        $productos = Productos::findOrFail($id);
        $productos->update($request->all());

        return redirect('/productos')->with('success', 'Producto Actualizado');
    }
    public function destroy($id)
    {
        $productos = Productos::findOrFail($id);
        $productos->delete(); // 👈 ya no elimina, solo oculta

        return redirect('/clientes')->with('success', 'Producto');
    }
}
