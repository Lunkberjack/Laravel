<?php
namespace App\Http\Controllers;
use App\Models\Product;
// use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller {
	public function __construct() {
		// Todas las funciones de esta clase quedan protegidas por
		// el middleware de autenticación, y si no se ha iniciado sesión
		// no se podrá acceder a ellas.
		$this->middleware('auth');
	}

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
	public function store(ProductRequest $request) {
/*		// REGLAS VALIDACIÓN
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
			->withInput($request()->all())
			// Se mete en la variable errors de PHP.
			->withErrors('If available must have stock');
		}
*/
//		FORMA BETA (no mentalidad tiburón)
//		$product = Product::create([
//			'title'=>request()->title,
//			'description'=>request()->description,
//			'price'=>request()->price,
//			'stock'=>request()->stock,
//			'status'=>request()->status,
//		]);
//		FORMA ALFA (real tiburón)
//		// Solo los que han sido validados con nuestras reglas
		$product = Product::create($request()->validated());
//		return redirect()->back();
//		return redirect()->action('MainController@index');
//		session()->flash('success', "The new product with id {$product->id} was created");
		return redirect()
			->route('products.index')
			->withSuccess("The new product with id {$product->id} was created");
//		Es igual a poner ->with(['success => "The new product with id...']);
	}
	// Poner Product $product es igual a poner la línea del findOrFail, es decir, 
	// Laravel buscará el producto por id (INYECCIÓN IMPLÍCITA DE MODELOS)
	public function show(Product $product) {
		// return "Showing product with id {$product} from CONTROLLER";
		// USANDO QUERY BUILDER
		// dd(DB::table('products')->where('id',  $product)->first());
		// find() encuentra el primer elemento con la id proporcionada.
 		// USANDO MODELOS (RECOMENDADO)
		// $product = Product::findOrFail($product);

		return view('products.show') ->with([
			'product' => $product
		]);
	}
	public function edit() {
//		return "Showing the form to edit the product with id {$product} from CONTROLLER";
		return view('products.edit')->with([
			//'product'=>Product::findOrFail($product),
			'product' => $product
		]);
	}
	public function update(ProductRequest $request, Product $product) {
/*		// REGLAS VALIDACIÓN
		$rules = [
			'title' => ['required', 'max:255'],
			'description' => ['required', 'max:1000'],
			'price' => ['required', 'min:1'],
			'stock' => ['required', 'min:0'],
			'status' => ['required', 'in:available,unavailable']
		];
		// VALIDAR
		request()->validate($rules);
*/
		//$product = Product::findOrFail($product);
		$product->update(request()->validated());
		return redirect()
			->route('products.index')
			->withSuccess("The product with id {$product->id} was edited");
	}
	public function destroy(Product $product) {
		// $product = Product::findOrFail($product);
		// Se elimina de la base de datos, pero no de la memoria del sistema.
		$product->delete();
		return redirect()
			->route('products.index')
			->withSuccess("The product with id {$product->id} was deleted");
	}
}