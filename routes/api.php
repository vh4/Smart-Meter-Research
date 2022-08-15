<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiToken;
use App\Http\Controllers\ApiData;
use App\Http\Controllers\ApiDataListrik;
use App\Http\Controllers\ApiRealtime;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//token and history token
Route::get('/token/{serialnumber}', [ApiToken::class, 'show']);
Route::post('/token/trigger/{serialnumber}', [ApiToken::class, 'trigger']);
Route::post('/token/history/{serialnumber}', [ApiToken::class, 'history']);

//untuk lstm prediksi actual
Route::get('/data/{serialnumber}', [ApiData::class, 'show']);
Route::post('/data/{serialnumber}', [ApiData::class, 'store']);

//data listrik

Route::post('/datalistrik/sisapulsa/{serialnumber}', [ApiDataListrik::class, 'update']);
Route::post('/datalistrik/pemakaian/{serialnumber}', [ApiDataListrik::class, 'edit']);


// realtime
Route::get('/realtime/data/{nomorserial_id}', [ApiRealtime::class, 'index']);

//grafik realtime
Route::get('/realtime/data/grafik/{nomorserial_id}/{jumlahdata}', [ApiRealtime::class, 'grafikRealtime']);
