@extends('app.layout')
@section('titulo')
    Pagina 4
@endsection

@section('contenido')
    <div class="card" style="max-width: 420px;">
        <form action="{{route('validar')}}" method="post">
            @csrf
            @if(session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function(){
                        Swal.fire({
                        title: "Bien",
                        text: "Validado todo",
                        icon: "success"
                        });
                    });
                </script>
            @endif
            <div class="card-body" >
            <div style="height: 3rem;" class ="d-flex flex-column justify-content-center align-items-center">
                <h1>DATOS</h1>
            </div>
            <div class ="d-flex flex-column justify-content-center align-items-center">
            <input 
            type="text" 
            name="correo" 
            id="correo" 
            placeholder="correo" 

            class="form-control @error('correo') @enderror"/>
                @error('correo')
                    <p class="bg-red-500 text-white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                
            />
            
            </div>
            <div style="height: 1rem;">

            </div>

            
            <div class ="d-flex flex-column justify-content-center align-items-center">
            <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            placeholder="Nombre" 
            class="form-control @error('nombre') @enderror"/>
                @error('nombre')
                    <p class="bg-red-500 text-white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                
            />
            
            </div>
            <div style="height: 1rem;">

            </div>




            <div class ="d-flex flex-column justify-content-center align-items-center">
                
                <input 
                type="text" 
                name="telefono" 
                id="telefono" 
                placeholder="Telefono" 
                class="form-control @error('telefono') @enderror"/>
                @error('telefono')
                    <p class="bg-red-500 text-white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                
            />
            </div>
            <div style="height: 1rem;">

                </div>

             <div class ="d-flex flex-column justify-content-center align-items-center">
                
                <input 
                type="text" 
                name="sexo" 
                id="sexo" 
                placeholder="Sexo" 
                class="form-control @error('sexo') @enderror"/>
                @error('sexo')
                    <p class="bg-red-500 text-white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                
            />
            </div>
            <div style="height: 1rem;">

                </div>

            <div class ="d-flex flex-column justify-content-center align-items-center">
                
                <input 
                type="text" 
                name="edad" 
                id="edad" 
                placeholder="Edad" 
                class="form-control @error('edad') @enderror"/>
                @error('edad')
                    <p class="bg-red-500 text-white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                
            />
            </div>
            <div style="height: 1rem;">

                </div>
            <div class ="d-flex flex-column justify-content-center align-items-center">
                <button 
                type="submit" class="btn btn-primary">Comprobar</button>
            </div>
                    
        </div>
        </form>
        
    </div>
@endsection