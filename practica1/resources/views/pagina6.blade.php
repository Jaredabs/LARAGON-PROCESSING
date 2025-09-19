@extends('app.layout')
@section('titulo')
    Pagina 4
@endsection

@section('contenido')
    <div class="card" style="max-width: 420px;">
        <form action="{{route('division')}}" method="post">
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
                <h1>Division</h1>
            </div>
            <div class ="d-flex flex-column justify-content-center align-items-center">
            <input type="text" name="numero1" id="numero1" placeholder="Numero 1" />
            
            </div>
            <div style="height: 1rem;">

            </div>
            
            <div class ="d-flex flex-column justify-content-center align-items-center">
                
                <input type="text" name="n2" id="n2" placeholder="Numero 2" />
            </div>
            <div style="height: 3rem;">

                </div>
            <div class ="d-flex flex-column justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Division</button>
            </div>
                    
        </div>
        </form>
        
    </div>
@endsection