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

Route::get('/sepedamotor', 'MotorController@index');
Route::get('/contoh', 'MotorController@coba');