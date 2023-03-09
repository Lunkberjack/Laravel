<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PanelController@index')->name('panel');
Route::resource('products', 'ProductController');

// Vídeo 99
Route::get('users', 'UserController@index')->name('users.index');
Route::post('users/admin/{user}', 'UserController@toggleAdmin')
    ->name('users.admin.toggle');
?>