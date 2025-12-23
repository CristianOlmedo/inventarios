@extends('adminlte::page')

@section('title', 'Editar Categoría')

@section('content_header')
<h1>Editar Categoría</h1>
@stop

@section('content')
<form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
    @csrf @method('PUT')

    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
    </div>

    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
    </div>

    <button class="btn btn-primary">Actualizar</button>
</form>
@stop
