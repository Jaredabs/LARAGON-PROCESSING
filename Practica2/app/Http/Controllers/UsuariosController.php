<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    //
    public function mostrarRegistro(){
        return view('registro');
    }

    public function hacerRegistro(Request $request){
       
     //   dd($request);
      $request->validate([
        'nombre' => 'required|max:50',
        'email'=> 'required|unique:users|min:5',
        'password'=> 'required|confirmed|min:5'

      ]);

      

        $rol = 'usuario';
        User::create([
            'name' => $request -> nombre,
            'rol' => $rol,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),//hass encripta
        ]);
        return back();
    }
}
