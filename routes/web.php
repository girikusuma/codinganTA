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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PagesController@home');
Route::get('/browsing', 'PagesController@browsing');
Route::get('/searching', 'PagesController@searching');

Route::get('/sepedamotor', 'MotorController@menu');
Route::get('/listmotor', 'MotorController@index');
Route::get('/listmotor/{idmotor}', 'MotorController@show');

Route::get('/listmerek', 'MerekController@index');
Route::get('/listmerek/{hasilmerek}', 'MerekController@show');

Route::get('/listtransmisi', 'TransmisiController@index');
Route::get('/listtransmisi/{hasiltransmisi}', 'TransmisiController@show');

Route::get('/listtype', 'TypeController@index');
Route::get('/listtype/{hasiltype}', 'TypeController@show');

Route::get('/listtahun', 'TahunController@index');
Route::get('/listtahun/{hasiltahun}', 'TahunController@show');

Route::get('/listvolumesilinder', 'VolumeController@index');
Route::get('/listvolumesilinder/{hasilvolume}', 'VolumeController@show');