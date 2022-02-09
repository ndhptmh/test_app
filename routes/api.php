<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/output', 'ProviderController@index');
Route::post('/input', 'ProviderController@store');
Route::get('/provider/{provider}', 'ProviderController@edit');
Route::put('/provider/update/{provider}', 'ProviderController@update');
Route::delete('/provider/{provider}', 'ProviderController@destroy');