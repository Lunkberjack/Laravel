<?php
namespace App\Http\Controllers;
use App\Product, Illuminate\Support\Facades\DB;

class ProductController extends Controller {
	public function index() {
		// return "This is the list of products from CONTROLLER";
		// USANDO QUERY BUILDER
		// dd(DB::table('products')->get());
		// USANDO MODELOS (RECOMENDADO) (IMPORTAR EL MODELO)
		$products = Product::all();

		return view('products.index')->with([
			// Para probar el condicional
			//'products' => [],
			'products' => Product::all(),
		]);
	}

	public function create() {
		return view('products.create');
	}
	public function store() {
		// REGLAS VALIDACIÓN
		$rules = [
			'title' => ['required', 'max:255'],
			'description' => ['required', 'max:1000'],
			'price' => ['required', 'min:1'],
			'stock' => ['required', 'min:0'],
			'status' => ['required', 'in:available,unavailable']
		];
		// VALIDAR
		request()->validate($rules);

		if(request()->status == 'available' && request()->stock == 0) {
			// Se crea un elemento llamado error para la sesión,
			// pero se elimina si se envía otra petición (o se refresca).
			// session()->flash('error', 'If available must have stock');
			// Pasamos las entradas que había introducido el usuario, para que 
			// no se pierdan.
			return redirect()
			->back()
			->withInput(request()->all())
			// Se mete en la variable errors de PHP.
			->withErrors('If available must have stock');
		}
		// FORMA BETA (no mentalidad tiburón)
//		$product = Product::create([
//			'title'=>request()->title,
//			'description'=>request()->description,
//			'price'=>request()->price,
//			'stock'=>request()->stock,
//			'status'=>request()->status,
//		]);
//		FORMA ALFA (real tiburón)
		$product = Product::create(request()->all());
//		return redirect()->back();
//		return redirect()->action('MainController@index');
//		session()->flash('success', "The new product with id {$product->id} was created");
		return redirect()
			->route('products.index')
			->withSuccess("The new product with id {$product->id} was created");
//		Es igual a poner ->with(['success => "The new product with id...']);
	}
	public function show($product) {
		// return "Showing product with id {$product} from CONTROLLER";
		// USANDO QUERY BUILDER
		// dd(DB::table('products')->where('id',  $product)->first());
		// find() encuentra el primer elemento con la id proporcionada.
 		// USANDO MODELOS (RECOMENDADO)
		$product = Product::findOrFail($product);

		return view('products.show') ->with([
			'product' => $product,
			'html' => "<h2>Subtitle</h2>",
		]);
	}
	public function edit($product) {
//		return "Showing the form to edit the product with id {$product} from CONTROLLER";
		return view('products.edit')->with([
			'product'=>Product::findOrFail($product),
		]);
	}
	public function update($product) {
		// REGLAS VALIDACIÓN
		$rules = [
			'title' => ['required', 'max:255'],
			'description' => ['required', 'max:1000'],
			'price' => ['required', 'min:1'],
			'stock' => ['required', 'min:0'],
			'status' => ['required', 'in:available,unavailable']
		];
		// VALIDAR
		request()->validate($rules);

		$product = Product::findOrFail($product);
		$product->update(request()->all());
		return redirect()
			->route('products.index')
			->withSuccess("The product with id {$product->id} was edited");
	}
	public function destroy($product) {
		$product = Product::findOrFail($product);
		// Se elimina de la base de datos, pero no de la memoria del sistema.
		$product->delete();
		return redirect()
			->route('products.index')
			->withSuccess("The product with id {$product->id} was deleted");
	}
}