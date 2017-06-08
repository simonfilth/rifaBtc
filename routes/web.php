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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['middleware' => ['web']], function () {

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es'
]);



Route::group(['middleware' => 'auth'], function () {

	Route::group(['middleware' => 'roles','roles' => 'Administrador'], function () {
		
		
		Route::get('mostrar-usuarios', 'AdminController@mostrarUsuarios');
		Route::get('agregar-usuario', 'AdminController@agregarUsuario');
		Route::post('guardar-usuario', 'AdminController@guardarUsuario');

		Route::get('eliminar-usuario/{id}', 'AdminController@eliminarUsuario');

		Route::get('mostrar-rifas', 'RifasController@mostrarRifas');
		Route::get('agregar-rifa', 'RifasController@agregarRifa');
		Route::post('guardar-rifa', 'RifasController@guardarRifa');
		Route::get('ver-rifa/{id}', 'RifasController@verRifa');
		Route::get('editar-rifa/{id}', 'RifasController@editarRifa');
		Route::patch('actualizar-rifa/{id}', 'RifasController@actualizarRifa');
		Route::get('eliminar-rifa/{id}', 'RifasController@eliminarRifa');
		Route::get('confirmar-pago/{id}', 'RifasController@confirmarPago');
		Route::get('agregar-sorteo', 'RifasController@agregarSorteo');
		Route::post('guardar-sorteo', 'RifasController@guardarSorteo');
	});

	Route::group(['middleware' => 'roles','roles' => ['Administrador', 'Cliente']], function () {
		Route::get('ver-usuario/{id}', 'AdminController@verUsuario');
		Route::get('unirse-a-sorteo', 'RifasController@unirseSorteo');
		Route::post('guardar-union-sorteo/{id}', 'RifasController@guardarUnionSorteo');
		Route::get('panel-cliente', 'ClientesController@panelCliente');
		Route::get('editar-usuario/{id}', 'AdminController@editarUsuario');
		Route::patch('actualizar-usuario/{id}', 'AdminController@actualizarUsuario');
		Route::patch('guardar-foto-usuario/{id}', 'AdminController@guardarFotoUsuario');
		Route::get('mostrar-participantes/{id?}', 'RifasController@mostrarParticipantes');
		Route::get('dashboard', 'AdminController@dashboard');
	});
});

});