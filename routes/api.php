<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/spareparts', 'SparepartsController@index');
Route::post('/spareparts/store', 'SparepartsController@store');
Route::get('/spareparts/{id?}', 'SparepartsController@show');
Route::post('/spareparts/update/{id?}', 'SparepartsController@update');
Route::delete('/spareparts/{id?}', 'SparepartsController@destroy');

Route::get('/transactions', 'TransactionsController@index');
Route::post('/transactions/store', 'TransactionsController@store');
Route::get('/transactions/{id?}', 'TransactionsController@show');
Route::post('/transactions/update/{id?}', 'TransactionsController@update');
Route::delete('/transactions/{id?}', 'TransactionsController@destroy');

Route::get('/detailtransactions', 'DetailTransactionsController@index');
Route::post('/detailtransactions/store', 'DetailTransactionsController@store');
Route::get('/detailtransactions/{id?}', 'DetailTransactionsController@show');
Route::post('/detailtransactions/update/{id?}', 'DetailTransactionsController@update');
Route::delete('/detailtransactions/{id?}', 'DetailTransactionsController@destroy');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
