<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Generar código basado en el nombre
        $codigo = Str::slug($request->nombre, '_');

        // Verificar si ya existe el producto con ese código
        $productoExistente = Producto::where('codigo', $codigo)
            ->where('categoria_id', $request->categoria_id)
            ->first();

        if ($productoExistente) {
            return redirect()->route('admin.productos.index')
                ->with('error', 'El producto ya existe en esa categoría.');
        }

        // Crear producto
        Producto::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'stock' => $request->stock,
            'codigo' => $codigo,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Generar nuevo código basado en el nombre
        $codigo = Str::slug($request->nombre, '_');

        // Verificar si existe otro producto con el mismo código y categoría
        $productoExistente = Producto::where('codigo', $codigo)
            ->where('categoria_id', $request->categoria_id)
            ->where('id', '!=', $producto->id)
            ->first();

        if ($productoExistente) {
            return redirect()->route('admin.productos.index')
                ->with('error', 'Ya existe otro producto con ese nombre en la misma categoría.');
        }

        $producto->update([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'stock' => $request->stock,
            'codigo' => $codigo,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
