<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/', 'MainController@index')->name('welcome');
// Así era antes de cambiarlo en el ej. 19
// Route::get('/', function () {
// 	return view('welcome');
// })->name('main');

// Route::get('products', function () {
// 	return "This is the list of products";
// })->name('products.index');

// // Esto tras crear el controller.
// Vamos a PublicController otra vez y creamos una acción
// con el mismo nombre que index
Route::get('products', 'ProductController@index')->name('products.index');

Route::get('products/create', 'ProductController@create')->name('products.create');

// Ahora mismo no se puede, pero se puede
// llamar products también (post y get son diferentes)
Route::post('products', 'ProductController@store')->name('products.store');

// Los parámetros se ponen entre llaves
// Si tenemos dos métodos (/create, /{product}) y
// escribimos primero el que pide parámetro, reconocerá
// create como parámetro, id de producto (incorrecto),
// por lo que este método debe estar debajo de products/create
Route::get('products/{product}', 'ProductController@show')->name('products.show');

Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');

// Laravel permite matchear varias opciones, es decir, si se recibe una ruta
// ya sea con ::put o ::patch, se realiza la función deseada
Route::match(['put', 'patch'], 'products/{product}', 'ProductController@update')->name('products.update');

Route::delete('products/{product}/edit', 'ProductController@destroy')->name('products.destroy');