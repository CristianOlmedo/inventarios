<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function create()
    {
        $productos = Producto::all();
        return view('admin.entradas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_compra' => 'required|numeric',
        ]);

        Entrada::create($request->all());

        // 🔥 Aumentar stock
        $producto = Producto::find($request->producto_id);
        $producto->increment('stock', $request->cantidad);

        return redirect()->back()->with('success', 'Entrada registrada');
    }
}
