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
//		Momento beta
//		$products = Product::where('status', 'available')			->get();
//		Momento alfa (usando scopes)
		$products = Product::available()->get();
		return view('welcome')->with(['products' => $products]);
	}
}
?>