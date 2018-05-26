<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{
	public function __construct() 
	{
		$this->middleware('example', ['only' =>['home']]);
	}

    public function home() {
    	return view('home');
    }

   /* public function contact() {
    	return view('contactos');
    }
    */

    public function saludos($nombre = "Invitado") {
    	$html = "<h2>Contenido html</h2>"; // Ingresado por formulario
		$script = "<script>alert('Problema XSS - Cross Site Scripting!')</script>"; // Ingresado por formulario

		$consolas = [
			"Play Station 4"
		];

		return view ('saludo', compact('nombre','html', 'script','consolas'));
    }

    /*public function mensajes(Request $request) {
    	//return $request->all();

    	if ($request->filled('nombre')){
    		return "Sí tiene nombre. Es ". $request->input('nombre') ." y su correo es ". $request->input('email');
    	} else {
    		return "No tiene nombre";
    	}

    	

    }*/

    /*
    public function mensajes(CreateMessageRequest $request) {
    	
    	$data =  $request->all(); // devuelve un array
    	
    	//return redirect()->route('contactos')->with('info', 'Tu mensaje se ha enviado con éxito');

    	return back()
    		->with('info', 'Tu mensaje se ha enviado con éxito');

    }
    */


}
