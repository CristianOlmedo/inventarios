@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.ventas.store') }}">
        @csrf

        <div class="form-group">
            <label>Producto</label>
            <select name="producto_id" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} - ${{ number_format($producto->precio_venta, 2) }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" min="1" required>
        </div>

        <button class="btn btn-primary mt-2">Registrar venta</button>
    </form>
</div>
@endsection
