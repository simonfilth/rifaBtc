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
Route::post('contactanos', 'HomeController@contactanos');

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

		Route::get('mostrar-sorteos', 'SorteosController@mostrarSorteos');
		Route::get('agregar-sorteo', 'SorteosController@agregarSorteo');
		Route::post('guardar-sorteo', 'SorteosController@guardarSorteo');
		Route::get('ver-sorteo/{id}', 'SorteosController@verSorteo');
		Route::get('editar-sorteo/{id}', 'SorteosController@editarSorteo');
		Route::patch('actualizar-sorteo/{id}', 'SorteosController@actualizarSorteo');
		Route::get('eliminar-sorteo/{id}', 'SorteosController@eliminarSorteo');
		Route::get('confirmar-pago/{id}', 'SorteosController@confirmarPago');
		Route::get('agregar-sorteo-en-curso', 'SorteosController@agregarSorteoEnCurso');
		Route::post('guardar-sorteo-en-curso', 'SorteosController@guardarSorteoEnCurso');

		Route::get('cargar-sorteos', 'SorteosController@cargarSorteos');
		Route::get('cargar-sorteo-en-curso', 'SorteosController@cargarSorteoEnCurso');
		Route::get('cargar-datos-dashboard', 'AdminController@cargarDatosDashboard');
		Route::get('cargar-datos-ganadores', 'AdminController@cargarDatosGanadores');
		Route::post('comenzar-sorteo-en-curso/{id}', 'SorteosController@comenzarSorteoEnCurso');
		Route::post('terminar-sorteo-en-curso/{id}', 'SorteosController@terminarSorteoEnCurso');
		Route::post('sorteo-no-realizado/{id}', 'SorteosController@sorteoNoRealizado');

		Route::get('jugar-ruleta', 'SorteosController@jugarRuleta');
		Route::get('asignar-ganadores', 'SorteosController@asignarGanadores');
		Route::get('asignar-premio/{sorteo_id}/{usuario_id}/{lugar}', 'SorteosController@asignarPremio');
		Route::get('cambiar-premio/{id}/{usuario_id}/{lugar}', 'SorteosController@cambiarPremio');
	});

	Route::group(['middleware' => 'roles','roles' => ['Administrador', 'Cliente']], function () {
		Route::get('ver-usuario/{id}', 'AdminController@verUsuario');
		Route::get('unirse-a-sorteo', 'SorteosController@unirseSorteo');
		Route::post('guardar-union-sorteo/{id}', 'SorteosController@guardarUnionSorteo');
		Route::get('panel-cliente', 'ClientesController@panelCliente');
		Route::get('editar-usuario/{id}', 'AdminController@editarUsuario');
		Route::patch('actualizar-usuario/{id}', 'AdminController@actualizarUsuario');
		Route::patch('guardar-foto-usuario/{id}', 'AdminController@guardarFotoUsuario');
		Route::get('mostrar-participantes/{id?}', 'SorteosController@mostrarParticipantes');
		Route::get('dashboard', 'AdminController@dashboard');

		Route::get('premios', 'SorteosController@premios');
		Route::get('sorteo-en-vivo', 'SorteosController@sorteoEnVivo');
	});
});

});