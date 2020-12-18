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

Route::apiResource('cve','CveController');
Route::apiResource('clients','ClientController');
Route::apiResource('productByClient','ProductsClientController');
Route::get('/database','DataBaseController@init');
Route::get('/product','DataBaseController@getProduct');
Route::get('/vendor','DataBaseController@getVendor');
Route::get('/version','DataBaseController@getVersion');
Route::get('/cvesByVendor/{nomVendor}','VendorController@getCveByVendor');
Route::get('/cvesByProduct/{nomProduct}','VendorController@getCveByProduct');
Route::get('/cves/{nomVendor}/{nomProduct}/{nomVersion}','VendorController@getCveWithVendorProductVersion');
Route::get('/cves/{nomVendor}/{nomProduct}','VendorController@getCveWithVendorProduct');
