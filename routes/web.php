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

Route::get('/prhospi', 'PrHospiController@index')->name('index');
Route::post('/prhospi/login', 'PrHospiController@login');
Route::get('/prhospi/logout', 'PrHospiController@logout');

Route::post('/prhospi/get_details', 'PrHospiController@getDetails');
Route::get('/prhospi/pr_form', 'PrHospiController@prForm');

Route::get('/prhospi/acco', 'PrHospiController@acco');
Route::post('/prhospi/check_pr', 'PrHospiController@checkPr');
Route::get('/prhospi/fix_acco', 'PrHospiController@fixAcco');
Route::get('/prhospi/acco_confirm', 'PrHospiController@confirmAcco');

Route::get('/prhospi/checkin', 'PrHospiController@checkin');

Route::get('/prhospi/checkout', 'PrHospiController@checkout');
Route::post('/prhospi/checkout_details', 'PrHospiController@checkoutDetails');
Route::get('/prhospi/confirm_checkout', 'PrHospiController@confirmCheckout');

Route::get('/prhospi/ambassador', 'PrHospiController@ambassador');
Route::post('/prhospi/amb_details', 'PrHospiController@ambDetails');
Route::get('/prhospi/confirm_refund', 'PrHospiController@confirmRefund');

Route::get('/prhospi/syed/special/stats', 'PrHospiController@syedSplStats');
