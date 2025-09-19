@extends('app.layout')
@section('titulo')
    Pagina 3
@endsection

@section('contenido')
    <div class="card" style="max-width: 420px;">
        <form action="{{route('suma')}}" method="post">
            @csrf
            @if(session('resultado'))
                <script>
                    document.addEventListener("DOMContentLoaded", function(){
                        Swal.fire({
                        title: "Resultado!",
                        text: "Resultado: {{session('resultado')}}",
                        icon: "success"
                        });
                    });
                </script>
            @endif
            <div class="card-body" >
            <div style="height: 3rem;" class ="d-flex flex-column justify-content-center align-items-center">
                <h1>Suma</h1>
            </div>
            <div class ="d-flex flex-column justify-content-center align-items-center">
            <input 
            type="text" 
            name="numero1" 
            id="numero1" 
            placeholder="Numero 1" 
            
            class="form-control @error('numero1') @enderror"/>
                @error('numero1')
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
                name="n2" 
                id="n2" 
                placeholder="Numero 2" 
                class="form-control @error('n2') @enderror"/>
                @error('n2')
                    <p class="bg-red-500 text white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                />
            </div>
            <div style="height: 3rem;">

                </div>
            <div class ="d-flex flex-column justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Suma</button>
            </div>
                    
        </div>
        </form>
        
    </div>
@endsection