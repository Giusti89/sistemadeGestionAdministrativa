@extends('layouts.cotizacion')
@section('titulo', 'Cotizacion')
@section('nombre', 'Cotizacion')
@section('contenido')
    @livewire('tabla-insumos', ['identificador' => $identificador])

@endsection