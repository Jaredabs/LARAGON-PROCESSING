@extends('app.inicio')
@section('title')
    Login
@endsection
@section('contenedor')

    <div class="container">
        <form>
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form2Example1" class="form-control" />
            <label class="form-label" for="form2Example1">Correo:</label>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" />
            <label class="form-label" for="form2Example2">Password:</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                
                
            </div>
            </div>

            
        </div>

        <!-- Submit button -->
        <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Iniciar Sesion</button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>no tienes cuenta? <a href="{{route('mostrar-registro')}}">Registro</a></p>
            <p>o iniciar sesion:</p>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
            </button>

            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
            <i class="fab fa-google"></i>
            </button>

            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
            <i class="fab fa-twitter"></i>
            </button>

            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
            <i class="fab fa-github"></i>
            </button>
        </div>
        </form>
    </div>
    
 @endsection