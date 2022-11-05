<?php

namespace App\Http\Controllers;

class MainController extends Controller {
	public function index() {
//		$name = config('app.name');
//		dump($name);
//		// Tras mostrar la variable, para la ejecucíón del programa.
//		dd("Hola mundo");
//		return view($name);
		return view('welcome');
	}
}
?>