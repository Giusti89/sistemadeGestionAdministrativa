@extends('layouts.base')
@section('titulo', 'Gastos diarios')
@section('nombre','Gastos')
@section('contenido')
    @livewire('tabla-gastos', ['userId' => auth()->user()->id])
@endsection