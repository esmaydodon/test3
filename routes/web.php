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
//los que no se autenticaron  en el sistema a donde van a tener acceso
Route::group(['middleware' =>['guest']], function () {
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});
//los usuarios autentificados van a tener acceso a las siguientes rutas
Route::group(['middleware' =>['auth']], function () {
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' =>['Almacenero']], function () {
        Route::get('/categoria','CategoriaController@index');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::get('/categoria/selectCategoria','CategoriaController@selectCategoria');

            //rutas de nueustro controlador
        Route::get('/articulo','ArticuloController@index');
        Route::post('/articulo/registrar','ArticuloController@store');
        Route::put('/articulo/actualizar','ArticuloController@update');
        Route::put('/articulo/desactivar','ArticuloController@desactivar');
        Route::put('/articulo/activar','ArticuloController@activar');

        Route::get('/proveedor','ProveedorController@index');
        Route::post('/proveedor/registrar','ProveedorController@store');
        Route::put('/proveedor/actualizar','ProveedorController@update');
    });
    // Route::group(['middleware' =>['Almacenero']], function () {});

    Route::group(['middleware' =>['Vendedor']], function () {
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
    });
    Route::group(['middleware' =>['Administrador']], function () {
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');

        Route::get('/categoria','CategoriaController@index');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::get('/categoria/selectCategoria','CategoriaController@selectCategoria');

            //rutas de nueustro controlador
        Route::get('/articulo','ArticuloController@index');
        Route::post('/articulo/registrar','ArticuloController@store');
        Route::put('/articulo/actualizar','ArticuloController@update');
        Route::put('/articulo/desactivar','ArticuloController@desactivar');
        Route::put('/articulo/activar','ArticuloController@activar');

        Route::get('/proveedor','ProveedorController@index');
        Route::post('/proveedor/registrar','ProveedorController@store');
        Route::put('/proveedor/actualizar','ProveedorController@update');

        Route::get('/rol','RolController@index');
        Route::get('/rol/selectRol','RolController@selectRol');//para select del fomulario asignar roles a usuarios
        
        Route::get('/user','UserController@index');
        Route::post('/user/registrar','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::put('/user/desactivar','UserController@desactivar');
        Route::put('/user/activar','UserController@activar');

    });  
    
    //Route::get('/home', 'HomeController@index')->name('home');
    //Marlon Martos Quiroz 2020 
    //Auth::routes();//se genera demanera automatica la ruta \login
    
});

// seagrego despues de php artisan ui:auth
// Route::get('/home', 'HomeController@index')->name('home');
