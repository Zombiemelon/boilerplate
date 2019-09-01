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
Route::post('/register', 'Auth\RegisterController@create');
Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
Route::post('/login', 'Auth\LoginController@login');
Route::get('/testpdf', function(Request $request){
    $number = $request['number'];
    $date = $request['date'];
    $dateForLoading = $request['date_of_loading'];
    $truckNumber = $request['truck_number'];
    $driver = $request['driver_name'];
    $driverPassport = $request['driver_passport'];
//    return view('invoice',
//        [
//            'number' => $number,
//            'date' => $date,
//            'truckNumber' => $truckNumber,
//            'driver' => $driver,
//            'driverPassport' => $driverPassport
//        ]);

    $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('invoice', [
        'number' => $number,
        'date' => $date,
        'truckNumber' => $truckNumber,
        'driver' => $driver,
        'driverPassport' => $driverPassport,
        'dateForLoading' => $dateForLoading
    ]);
    return $pdf->download('invoice.pdf');
});
Route::get('/testpdf2', function(){
    $number = 97;
    $date = '22-08-2019';
    $dateForLoading = '23-24/08/2019';
    $truckNumber = 'NT-30-BKM / NT-31-BKM';
    $driver = 'Чиореску Андрей (Ciorescu Andrei)';
    $driverPassport = 'АВ 0520302';
    return view('invoice',
        [
            'number' => $number,
            'date' => $date,
            'truckNumber' => $truckNumber,
            'driver' => $driver,
            'driverPassport' => $driverPassport,
            'dateForLoading' => $dateForLoading
        ]);
    $pdf = PDF::loadView('invoice', [
        'number' => $number,
        'date' => $date,
        'truckNumber' => $truckNumber,
        'driver' => $driver,
        'driverPassport' => $driverPassport,
        'dateForLoading' => $dateForLoading
    ]);
    return $pdf->download('invoice.pdf');
});
