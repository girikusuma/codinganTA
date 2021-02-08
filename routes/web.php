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

Route::get('/sepedamotor', 'MotorController@menu');
Route::get('/listmotor', 'MotorController@index')->name('listmotor.index');
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

Route::get('/dealer', 'DealerController@index');
Route::get('/dealer/{hasilprovinsi}', 'DealerController@location');
Route::get('/dealer/{daerah}/{namakabupaten}', 'DealerController@show');
Route::get('/dealer/{provinsi}/{kabupaten}/{namadealer}', 'DealerController@detail');

Route::get('/servicecentre', 'ServiceController@index');
Route::get('/servicecentre/{hasilprovinsi}', 'ServiceController@location');
Route::get('/servicecentre/{daerah}/{namakabupaten}', 'ServiceController@show');
Route::get('/servicecentre/{provinsi}/{kabupaten}/{namadealer}', 'ServiceController@detail');

Route::get('/searching', 'SearchingController@index')->name('searching.index');
Route::get('/searching/getdata', 'SearchingController@getData')->name('searching.getData');

Route::get('/rekomendasi', 'RekomendasiController@index');
Route::post('/rekomendasi/result', 'RekomendasiController@getSAW');

Route::get('/coba', 'CobaController@index')->name('coba.index');
Route::get('/coba/getdata', 'CobaController@getData')->name('coba.getData');
Route::post('/coba/filterdata', 'CobaController@filterData')->name('coba.filterData');