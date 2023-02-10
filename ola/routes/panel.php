<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PanelController@index')->name('panel');
Route::resource('products', 'ProductController');

?>