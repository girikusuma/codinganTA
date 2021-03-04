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

Route::get('/', 'PagesController@home')->name('home');
Route::get('/browsing', 'PagesController@browsing')->name('browsing');
Route::get('/info', 'PagesController@info')->name('info');

Route::get('/sepedamotor', 'MotorController@menu')->name('sepedamotor');
Route::get('/listmotor', 'MotorController@index')->name('listmotor.index');
Route::get('/listmotor/{idmotor}', 'MotorController@show')->name('listmotor.show');

Route::get('/listmerek', 'MerekController@index')->name('listmerek.index');
Route::get('/listmerek/{hasilmerek}', 'MerekController@show')->name('listmerek.show');

Route::get('/listtransmisi', 'TransmisiController@index')->name('listtransmisi.index');
Route::get('/listtransmisi/{hasiltransmisi}', 'TransmisiController@show')->name('listtransmisi.show');

Route::get('/listtype', 'TypeController@index')->name('listtype.index');
Route::get('/listtype/{hasiltype}', 'TypeController@show')->name('listtype.show');

Route::get('/listtahun', 'TahunController@index')->name('listtahun.index');
Route::get('/listtahun/{hasiltahun}', 'TahunController@show')->name('listtahun.show');

Route::get('/listvolumesilinder', 'VolumeController@index')->name('listvolume.index');
Route::get('/listvolumesilinder/{hasilvolume}', 'VolumeController@show')->name('listvolume.show');

Route::get('/dealer', 'DealerController@index')->name('dealer.index');
Route::get('/dealer/{hasilprovinsi}', 'DealerController@location')->name('dealer.location');
Route::get('/dealer/{daerah}/{namakabupaten}', 'DealerController@show')->name('dealer.show');
Route::get('/detail/dealer/{namadealer}', 'DealerController@detail')->name('dealer.detail');

Route::get('/servicecentre', 'ServiceController@index')->name('service.index');
Route::get('/servicecentre/{hasilprovinsi}', 'ServiceController@location')->name('service.location');
Route::get('/servicecentre/{daerah}/{namakabupaten}', 'ServiceController@show')->name('service.show');
Route::get('/detail/servicecentre/{namaservice}', 'ServiceController@detail')->name('service.detail');

Route::get('/searching', 'SearchingController@index')->name('searching.index');
Route::get('/searching/getdata', 'SearchingController@getData')->name('searching.getData');

Route::get('/rekomendasi', 'RekomendasiController@index')->name('rekomendasi.index');
Route::post('/rekomendasi/result', 'RekomendasiController@getSAW')->name('rekomendasi.result');
Route::post('/rekomendasi/hasil', 'RekomendasiController@getSAWcheck')->name('rekomendasi.hasil');