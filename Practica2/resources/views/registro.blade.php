@extends('app.inicio')
@section('title')
    Registro
@endsection
@section('contenedor')


<div class="card" style="max-width: 420px;">
        <form action="{{ route('hacer-registro') }}" method="POST">
            @csrf
            
            <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                      <label class="form-label" for="nombre">Nombre:</label>
            <input 
                name="nombre" 
                type="text" 
                id="nombre" 
                class="form-control @error('nombre') is-invalid @enderror" />
            @error('nombre')
                <p class="bg-red-500 text-white my-2 text-center p-2">
                    {{$message}}
                </p>
            @enderror
        </div>

                <div data-mdb-input-init class="form-outline mb-4">

                <label class="form-label" for="email">Email:</label>
                <input 
                name="email" 
                type="email" 
                id="form2Example1" 
                class="form-control @error('email') is-invalid @enderror" />

              

                @error('email')
                    <p class="bg-red-500 text-white my-2 text-center p-2">
                        {{$message}}
                    </p>
                @enderror
                </div>


                
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input name="password" type="password" id="form2Example2" class="form-control @error('password') is-invalid @enderror" />

                    <label class="form-label" for="password">Password:</label>

                    @error('password')
                        <p class="bg-red-500 text-white my-2 text-center p-2">
                            {{$message}}
                        </p>
                    @enderror
                </div>



                <div data-mdb-input-init class="form-outline mb-4">
                    <input name="password_confirmation" type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />

                    <label class="form-label" for="password">Comnfirmar password</label>

                    @error('password_confirmation')
                        <p class="bg-red-500 text-white my-2 text-center p-2">
                            {{$message}}
                        </p>
                    @enderror
                        </div>
                <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Registrar</button>

            
        </form>
        
    </div>
@endsection  