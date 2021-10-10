<?php

use App\Events\SimpleNotifEvent;
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

Route::get('data', 'GudangMaterialController@getData');
Route::get('bppb', 'GudangMaterialController@getBppb');
Route::get('bom/{id}', 'GudangMaterialController@getBom');
Route::get('bom-table/{id}', 'GudangMaterialController@getBomTable');

Route::get("example-data", "GudangMaterialController@getExampleData");


//PPIC
Route::group(['prefix' => 'ppic'], function () {
    // get
    Route::get('/event/{status}', 'PpicController@getEvent');
    Route::get('/get-all-detail-produk', 'PpicController@getAllDetailProduk');
    Route::get('/version-bom-product/{id}', 'PpicController@getVersionBomProduct');
    Route::get('/get-max-quantity/{id}', 'PpicController@getMaxQuantity');
    // change
    Route::post('/add-event', 'PpicController@addEvent');
    Route::post('/delete-event', 'PpicController@deleteEvent');
    Route::post('/update-confirmation', 'PpicController@updateConfirmationEvent');

});

Route::get("/change-confirmation/{user}/{message}", function($user, $message){
    event(new SimpleNotifEvent($user, $message));
});

Route::post('/login', 'LoginController@login');