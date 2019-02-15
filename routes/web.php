<?php

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
/*
DB::listen(function($query){
	echo "<pre>{$query->sql}</pre>";
});*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
/**Registro**/
Route::resource('registro','registro');
/**usuarios**/
Route::resource('usuario','UserController');
/**Roles**/
Route::get('roles',function(){
	return \App\Role::with('user')->get();
});

/**Estados**/
Route::resource('estado','EstadoController');

/**Grupos**/

Route::resource('grupo','GrupoController');

/**Categorias**/
Route::resource('categoria','CategoriaController');

/**Pre Create Notas **/
Route::get('precreate','PreCreateNota@index')->name('precreatenota.index');
Route::post('precreate','PreCreateNota@enviar')->name('precreatenota.enviar');

/**Notas**/
Route::resource('nota','NotaController');
Route::get('nota/crear/{id}','NotaController@create')->name('nota.create');



/*login*/
Route::get('login','Auth\LoginCotroller@showLoginForm')->name('login');
/*
Route::get('registro',['as'=>'registro.index', 'uses'=>'registro@index']);
Route::get('registro/crear',['as'=>'registro.create', 'uses'=>'registro@create']);
Route::post('registro',['as'=>'registro.store', 'uses'=>'registro@store']);
Route::get('registro/{id}',['as'=>'registro.show','uses'=>'registro@show']);
Route::get('registro/{id}/edit',['as'=>'registro.edit','uses'=>'registro@edit']);
Route::put('registro/{id}',['as'=>'registro.update','uses'=>'registro@update']);
Route::delete('registro/{id}',['as'=>'registro.destroy','uses'=>'registro@destroy']);*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 
