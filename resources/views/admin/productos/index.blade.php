@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">
        Nuevo Producto
    </a>

    {{-- Mensajes de alerta --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</td>
                <td>{{ $producto->stock }}</td>
                <td>${{ number_format($producto->precio_venta, 2) }}</td>
                <td>
                    <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('admin.productos.destroy', $producto) }}"
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar producto?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No hay productos registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
