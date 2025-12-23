<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VentasExport;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('admin.ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock < $request->cantidad) {
            return back()->withErrors('Stock insuficiente');
        }

        $subtotal = $producto->precio_venta * $request->cantidad;
        $iva = $subtotal * 0.19; // IVA 19%
        $total = $subtotal + $iva;

        Venta::create([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $producto->precio_venta,
            'iva' => $iva,
            'total' => $total,
        ]);

        $producto->decrement('stock', $request->cantidad);

        return redirect()->route('admin.ventas.index')
            ->with('success', 'Venta registrada correctamente con IVA 19%');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        // Opcional: devolver el stock del producto
        if ($venta->producto) {
            $venta->producto->increment('stock', $venta->cantidad);
        }

        $venta->delete();

        return redirect()->route('admin.ventas.index')
            ->with('success', 'Venta eliminada correctamente');
    }

    // Generar PDF
    public function exportPDF()
    {
        $ventas = Venta::with('producto')->get();
        $pdf = PDF::loadView('admin.ventas.pdf', compact('ventas'));
        return $pdf->download('ventas.pdf');
    }

}
