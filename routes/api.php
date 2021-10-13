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

Route::post('daftar_karyawan/aksi_tambah', 'KaryawanController@karyawan_aksi_tambah');
Route::post('daftar_karyawan/add', 'KaryawanController@addUser');
