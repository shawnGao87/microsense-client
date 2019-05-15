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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/health', 'HealthController@index');
Route::get('/operations', 'OperationController@index');
Route::get('/readers', 'ReaderController@getReaders');

Route::get('/', 'ReaderController@index');
Route::post('/jobs', 'JobController@store');
