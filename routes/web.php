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

// DB::listen(function($query){
// 	echo "<pre>{$query->sql}</pre>";
// });

Route::get('/', 'IndexController@index')->name('index');

Route::group([
	'prefix'=>'',
	'namespace'=>'Privado',
	'middleware'=>'auth'],
	function ()
	{
		Route::resource('usuarios','UsuariosController',['except' =>'destroy']);
		Route::get('usuarios.buscar','UsuariosController@buscar')->name('usuarios.buscar');

		Route::resource('roles','RolesController',['except' =>['destroy','show']]);
		Route::get('roles.buscar','RolesController@buscar')->name('roles.buscar');

		Route::put('usuarios/{usuario}/roles','UsersRolesController@update')->name('usuarios.roles.update');

		Route::put('usuarios/{usuario}/permissions','UsersPermissionsController@update')->name('usuarios.permissions.update');
	}
);


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home');
