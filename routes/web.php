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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/driver', 'DriverController@index');

Route::get('/grid', 'GridController@carComponents')->name('grid');

Route::get('/component', 'CarComponent\CarComponentController@index');
Route::get('/component/{id}', 'CarComponent\CarComponentController@show')->where('id', '\d+');
Route::get('/component/compare/{id1}/{id2}', 'CarComponent\CarComponentController@compare');
Route::get('/component/groups', 'CarComponent\CarComponentController@groups');


Route::post('component/assign', 'CarComponent\AssignCarComponentController@assignCarComponentToUser')->name('car-component.assign');
Route::post('component/upgrade', 'CarComponent\UpgradeCarComponentController@upgradeCarComponent')->name('car-component.upgrade');


Route::get('test', 'GridController@test');
