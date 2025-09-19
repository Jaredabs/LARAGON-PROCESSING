<?php

namespace App\Http\Controllers;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ImageController extends Controller
{
    public function show(){
        return view('registro');
    }

    public function create(REQUEST $request){
        $request->validate([
        'name' => 'required|max:50',
        'email'=> 'required|unique:users|email',
        'password'=> 'required|confirmed|min:5',
        'img' => 'image',
      ]);

      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'rol' => 'usuario',
        'password' => Hash::make($request->password),
      ]);

      $rutaCarpeta = public_path("imagenes/imgusuario/");
      if($request->hasFile('img')){
        if(!file_exists($rutaCarpeta)){
            mkdir($rutaCarpeta, 0777,true);
        }
        $foto = $request -> file('img');
        $nombreImg = time()."_".$foto->getClientOriginalName();
        $foto->move($rutaCarpeta,$nombreImg);
        $rutalogica = "imagenes/imgusuario";
      }
      

      $userfoto = Image::create([
        'ruta' => $rutalogica . $nombreImg,
        'user_id' => $user->id,
      ]);

      return redirect()->route('inicio')->with('creado' ,'creado');
    }

    public function validar(Request $request ){
        $request->validate([
        'email' => 'required|email',
        'password'=> 'required|min:3',
        
      ]);

      if(auth()->attempt($request->only('email','password'))){
        //$persona = User::all();obteneer todos campos de tabla
        $persona = auth()->user();//obtner usuario autentificado
        
        $imagen = Image::where('user_id', $persona->id)->get()->first();
        dd($imagen);
        return view('inicio',compact('persona','imagen'));//enviar a inicio en variabe compactada
      }else{
             
             return back()->with('error','error');
      }
     
    }
}
