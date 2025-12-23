@extends('adminlte::page')

@section('title', 'Nueva Categoría')

@section('content_header')
<h1>Nueva Categoría</h1>
@stop

@section('content')
<form action="{{ route('admin.categorias.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Guardar</button>
</form>
@stop
