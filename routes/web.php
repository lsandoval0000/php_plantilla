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
		// Usuarios y Roles
		Route::resource('usuarios','UsuariosController',['except' =>'destroy']);
		Route::get('usuarios.buscar','UsuariosController@buscar')->name('usuarios.buscar');

		Route::resource('roles','RolesController',['except' =>['destroy','show']]);
		Route::get('roles.buscar','RolesController@buscar')->name('roles.buscar');

		Route::put('usuarios/{usuario}/roles','UsersRolesController@update')->name('usuarios.roles.update');

		Route::put('usuarios/{usuario}/permissions','UsersPermissionsController@update')->name('usuarios.permissions.update');
		// Usuarios y Roles

		
	}
);

// Autenticación
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home');
// Autenticación

// Instalador
Route::get('/installation', 'Install\InstallerController@index')->name('installer');
Route::get('install/database', 'Install\InstallerController@database');
Route::post('install/process_install', 'Install\InstallerController@process_install');
Route::get('install/create_user', 'Install\InstallerController@create_user');
Route::post('install/store_user', 'Install\InstallerController@store_user');
Route::get('install/system_settings', 'Install\InstallerController@system_settings');
Route::post('install/finish', 'Install\InstallerController@final_touch');
// Instalador