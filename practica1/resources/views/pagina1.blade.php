@extends('app.layout')
@section('titulo')
    Pagina 1
@endsection

@section('contenido')
    <div class="container py-4">
    <div class="card mx-auto" style="max-width: 600px;">
        
        <div class="card-body text-center">
        <!-- Imagen o contenido de la diapositiva -->
        <img src="img/imagen.jpeg" alt="Slide 1" style="width:100%; height:auto; display:block; border-radius:6px;">
        <h5 class="mt-3 mb-1">Feli</h5>
        <p class="text-muted mb-0">La felicidad el motivo principal de seguir adelante</p>


        <img src="img/chivas.jpeg" alt="Slide 1" style="width:100%; height:auto; display:block; border-radius:6px;">
        <h5 class="mt-3 mb-1">CD GUADALAJARA</h5>
        <p class="text-muted mb-0">Equipo con mas tradicion de mexico</p>
        </div>

        <img src="img/lm.jpeg" alt="Slide 1" style="width:100%; height:auto; display:block; border-radius:6px;">
        <h5 class="mt-3 mb-1">Luis Miguel</h5>
        <p class="text-muted mb-0">Artista mas famoso de latinoamerica en los 90's</p>
        </div>
    </div>
    </div>
@endsection