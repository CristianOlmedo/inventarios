<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class VentasExport implements FromView
{
    public function view(): View
    {
        $ventas = Venta::with('producto')->get();

        return view('admin.ventas.excel', [
            'ventas' => $ventas
        ]);
    }
}
