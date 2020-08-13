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

Route::resource('ordres','OrdreController');

// Route::get('/historic', 'OrdreController@index')->name('historic');

// Route::delete('/historic/destroy/{ordre}', 'OrdreController@destroy')->name('historic.destroy');

// Route::get('/historic/edit/', 'OrdreController@edit')->name('historic.edit');

// Route::get('/historic/{ordre}/actualitza/', 'OrdreController@update')->name('historic.actualitza');

Route::get('/historic/indexOEE', 'IndexController@index')->name('historic.index');

Route::delete('/historic/index/destroy/{oee}', 'IndexController@destroy')->name('historic.index.destroy');

Route::get('/login', 'FrontEndController@page')->name('login');

Route::get('/aturades', 'FrontEndController@aturades')->name('pantallaAturades');

Route::get('/aturades/acaba', 'GraficsController@acabaAturades')->name('acabaAturades');

Route::post('/principal/defectuoses', 'FrontEndController@afegeixUnitatsDefectuoses')->name('defectuoses');

Route::get('/principal', 'GraficsController@getAllData')->name('principal');

Route::get('/teclat', 'FrontEndController@page')->name('teclatNumeric');

Route::post('/principal/inserta', 'GraficsController@emplenaOrdrePrimer')->name('inserta');

Route::get('/', 'FrontEndController@home')->name('index');

Route::get('/principal/repren', 'GraficsController@repren')->name('repren');





//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
