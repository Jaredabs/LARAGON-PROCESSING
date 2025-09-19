@extends('app.layout')
@section('titulo')
    Pagina 2
@endsection

@section('contenido')
    <div style="height: 3rem;" class ="d-flex flex-column justify-content-center align-items-center">
        <h1>Login</h1>
        </div>
    <div class ="d-flex flex-column justify-content-center align-items-center">
        <input type="text" name="correo" id="corr" placeholder="Correo" />
        
    </div>
    <div style="height: 1rem;">

        </div>
    <div class ="d-flex flex-column justify-content-center align-items-center">
        
        <input type="text" name="Contraseña" id="cont" placeholder="Contraseña" />
    </div>
    <div style="height: 3rem;">

        </div>
    <div class ="d-flex flex-column justify-content-center align-items-center">
        <button type="button" class="btn btn-primary">Iniciar sesion</button>
    </div>
    
@endsection