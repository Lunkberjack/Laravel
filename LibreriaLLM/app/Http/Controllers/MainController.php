<?php

namespace App\Http\Controllers;
use App\Models\Product;

class MainController extends Controller {
	public function index() {
//		$name = config('app.name');
//		dump($name);
//		Tras mostrar la variable, para la ejecucíón del programa.
//		dd("Hola mundo");
//		return view($name);
//		Versión 1
//		$products = Product::where('status', 'available')			->get();
//		Versión 2 (usando scopes)
//		$products = Product::available()->get();
//		Versión final (global scopes)
		\DB::connection()->enableQueryLog();
		// images es el nombre de la relación
		// (o función en el Models\Product)
		$products = Product::all();
		return view('welcome')->with(['products' => $products]);
	}
}
?>