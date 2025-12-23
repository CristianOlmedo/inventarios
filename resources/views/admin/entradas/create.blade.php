@extends('adminlte::page')

@section('title', 'Entrada de Inventario')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.entradas.store') }}">
        @csrf

        <div class="form-group">
            <label>Producto</label>
            <select name="producto_id" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control">
        </div>

        <div class="form-group">
            <label>Precio de compra</label>
            <input type="number" step="0.01" name="precio_compra" class="form-control">
        </div>

        <button class="btn btn-success">Registrar entrada</button>
    </form>
</div>
@endsection
