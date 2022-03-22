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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('/infos/index', 'InfoController@index')->name('infos/index');
Route::get('/infos/create', 'InfoController@create')->name('create');
Route::post('infos/store', 'InfoController@store')->name('store');
Route::get('/infos/{id}', 'InfoController@show')->name('infos/show');
Route::get('/infos/edit/{id}', 'InfoController@edit')->name('info/edit');
Route::post('/infos/update/{id}', 'InfoController@update')->name('infos/update');
Route::post('infos/delete/{id}', 'InfoController@delete')->name('delete');

Route::get('/reservations/index', 'ReservationController@index')->name('reservations/index');
Route::get('/reservations/create', 'ReservationController@create')->name('reservations/create');
Route::post('/reservations/create', 'ReservationController@create')->name('reservations/create');
Route::post('/reservations/store', 'ReservationController@store')->name('reservations/store');
Route::get('/reservations/{id}', 'ReservationController@show')->name('show');
Route::get('/reservations/edit/{id}', 'ReservationController@edit')->name('edit');
Route::post('/reservations/update/{id}', 'ReservationController@update')->name('reservations/update');
Route::get('/reservations/update/{id}', 'ReservationController@update')->name('reservations/update');
Route::post('reservations/delete/{id}', 'ReservationController@delete')->name('delete');

Route::get('/reservations/sales/sum_sale', 'ReservationController@sum_sale')->name('reservations/sum_sale');
Route::get('/reservations/sales/ave_sale', 'ReservationController@ave_sale')->name('reservations/ave_sale');
Route::get('/reservations/sales/month_ave_sale', 'ReservationController@month_ave_sale')->name('reservations/month_ave_sale');
Route::get('/reservations/sales/month_sum_sale', 'ReservationController@month_sum_sale')->name('reservations/month_sum_sale');
Route::resource('reservations', 'ReservationController');
Route::resource('infos', 'InfoController');
});


// Route::resource('reservations', 'ReservationController');
// Auth::routes(['verify' => true]);
// Route::get('/infos/index', 'InfoController@index')->middleware('verified');
// Route::get('/reservations/index', 'ReservationController@index')->middleware('verified');