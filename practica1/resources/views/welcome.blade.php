@extends('app.layout')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    <img src="{{ asset('img/imagen.jpeg') }}" 
         alt="Imagen de fondo"
         style="width: 100vw; height: 100vh; object-fit: cover;">
@endsection