<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasController extends Controller
{
    public function mostrarAyuda(){

        return view('ayuda');

    }
    public function mostrarInicio(){

        return view('inicio');
        
    }
    public function mostrarPag1(){

        return view('pagina1');
        
    }
    public function mostrarPag2(){

        return view('pagina2');
        
    }
    public function mostrarPag3(){

        return view('pagina3');
        
    }

    public function mostrarPag4(){

        return view('pagina4');
        
    } 

    public function mostrarPag5(){

        return view('pagina5');
        
    } 

    public function mostrarPag6(){

        return view('pagina6');
        
    } 

    public function mostrarPag7(){

        return view('pagina44');
        
    } 

    public function hacerSuma(Request $request){
        $request->validate([
                'numero1' => 'required|numeric|max: 5',
                'n2' => 'required|numeric|max: 5',
            ]);
        //dd($request->numero1);
        $n1 = $request->numero1;
        $nu2 = $request->n2;

        $suma = $n1 + $nu2;
        //dd($suma);

        return back()->with('resultado',$suma);
    }
    public function hacerResta(Request $request){
        $request->validate([
                'numero1' => 'required|numeric|max: 5',
                'n2' => 'required|numeric|max: 5',
            ]);
        //dd($request->numero1);
        $n1 = $request->numero1;
        $nu2 = $request->n2;

        $resta = $n1 - $nu2;
        //dd($suma);

        return back()->with('resultado',$resta);
    }
    public function hacerMultiplicacion(Request $request){

        //dd($request->numero1);
        $n1 = $request->numero1;
        $nu2 = $request->n2;

        $multiplicacion = $n1 * $nu2;
        //dd($suma);

        return back()->with('resultado',$multiplicacion);
    }
    public function hacerDivision(Request $request){

        //dd($request->numero1);
        $n1 = $request->numero1;
        $nu2 = $request->n2;

        $division = $n1 / $nu2;
        //dd($suma);

        return back()->with('resultado',$division);
    }

    public function hacerVal(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|regex:/^[\pL\s]+$/u',
            'edad'     => 'required|integer|min:0|max:120',
            'correo'   => 'required|email',
            'telefono' => 'required|digits:10',
            'sexo'     => 'required|in:m,f,M,F',
        ]);

        // Aquí guardas en BD o procesas los datos
        return back()->with('success', 'Datos validados y guardados correctamente');
    }
}
