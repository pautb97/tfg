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

Route::get('/historicOrdre', 'OrdreController@index')->name('historicOrdre.index');

Route::delete('/OrdreOrdre/destroy/{ordre}', 'OrdreController@destroy')->name('historicOrdre.destroy');

Route::get('/historicOrdre/edit/', 'OrdreController@edit')->name('historicOrdre.edit');

Route::get('/historicOrdre/{ordre}/actualitza/', 'OrdreController@update')->name('historicOrdre.actualitza');


Route::get('/historicConsum', 'ConsumController@index')->name('historicConsum.index');

Route::delete('/historicConsum/destroy/{Consum}', 'ConsumController@destroy')->name('historicConsum.destroy');

Route::get('/historicConsum/edit/', 'ConsumController@edit')->name('historicConsum.edit');

Route::get('/historicConsum/{Consum}/actualitza/', 'ConsumController@update')->name('historicConsum.update');


Route::get('/historicIndex/indexOEE', 'IndexController@index')->name('historicIndex.index');

Route::delete('/historicIndex/index/destroy/{oee}', 'IndexController@destroy')->name('historicIndex.destroy');


Route::get('/login', 'GraficsController@page')->name('login');

Route::get('/aturades', 'GraficsController@aturades')->name('pantallaAturades');

Route::get('/aturades/acaba', 'GraficsController@acabaAturades')->name('acabaAturades');

Route::post('/principal/defectuoses', 'GraficsController@afegeixUnitatsDefectuoses')->name('defectuoses');

Route::get('/principal', 'GraficsController@getAllData')->name('principal');

Route::get('/teclat', 'GraficsController@page')->name('teclatNumeric');

Route::post('/principal/inserta', 'GraficsController@emplenaOrdrePrimer')->name('inserta');

Route::get('/', 'GraficsController@home')->name('index');

Route::get('/principal/repren', 'GraficsController@repren')->name('repren');





//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
