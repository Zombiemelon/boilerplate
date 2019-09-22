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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Auth\RegisterController@create');
Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
Route::post('/login', 'Auth\LoginController@login');
Route::get('/document', 'DocumentController@getDocument')->middleware('document');
Route::get('/drivers', 'DocumentController@getAllDrivers');
Route::get('/trucks', 'DocumentController@getAllCars');
Route::get('/last_document_number', 'DocumentController@getLastDocumentNumber');
