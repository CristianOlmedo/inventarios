@extends('adminlte::page')

@section('title', 'Panel Admin')

@section('content_header')
    <h1>Dashboard Administrador</h1>
@stop

@section('content')
    <p>Bienvenido {{ auth()->user()->name }}</p>
@stop
