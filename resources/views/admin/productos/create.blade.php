@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <select name="categoria_id" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Precio Compra</label>
            <input type="number" step="0.01" name="precio_compra" class="form-control">
        </div>

        <div class="form-group">
            <label>Precio Venta</label>
            <input type="number" step="0.01" name="precio_venta" class="form-control">
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
