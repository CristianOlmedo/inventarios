@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre</label>
            <input name="nombre" class="form-control" value="{{ $producto->nombre }}">
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <select name="categoria_id" class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        @selected($producto->categoria_id == $categoria->id)>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Precio Compra</label>
            <input type="number" step="0.01" name="precio_compra"
                   value="{{ $producto->precio_compra }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Precio Venta</label>
            <input type="number" step="0.01" name="precio_venta"
                   value="{{ $producto->precio_venta }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock"
                   value="{{ $producto->stock }}" class="form-control">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
