@extends('app.base')
@section('title')
    Inicio
@endsection
@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
  <div class="max-w-sm w-full bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all">
    <div class="relative">
      <img 
        src="{{$imagen->ruta}}"
        alt="Product"
        class="w-full h-52 object-cover"
      />
      <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
        Sale
      </span>
    </div>
    
    <div class="p-5 space-y-4">
      <div>
        <h3 class="text-xl font-bold text-gray-900">{{$persona->email}}</h3>
        <p class="text-gray-500 mt-1">{{$persona->name}}</p>
      </div>
      
      

      <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-lg transition-colors">
        Cerrar sesion
      </button>
    </div>
  </div>
</div>
@endsection