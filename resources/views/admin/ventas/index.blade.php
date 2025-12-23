@extends('adminlte::page')

@section('title', 'Ventas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.ventas.create') }}" class="btn btn-primary">
            Nueva Venta
        </a>

        <div>
            <a href="{{ route('admin.ventas.pdf') }}" class="btn btn-danger">Exportar PDF</a>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>IVA 19%</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ventas as $venta)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $venta->producto?->nombre ?? 'Sin producto' }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>${{ number_format($venta->precio_unitario, 2) }}</td>
                <td>${{ number_format($venta->iva, 2) }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>
                    <form action="{{ route('admin.ventas.destroy', $venta) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar venta?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
