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

Route::get('/parking','ParkingController@parking');
route::get('/corridor_lighting','ParkingController@corridor_lighting');
route::get('/security','ParkingController@security');

route::get('/charts','ChartsController@charts');
