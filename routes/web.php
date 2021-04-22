<?php

use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    // return view('welcome');
    return redirect('/home');
});

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/chat', 'ChatController@index');
Route::get('/message', 'ChatController@fetchMessages');
Route::post('/message', 'ChatController@sendMessage');

// Route::get('/default_form', function () {
//     return view('page.default_form');
// });

//Karyawan
/* Tabel */
Route::get('/karyawan', 'CommonController@karyawan');
Route::get('/karyawan/tambah', 'CommonController@karyawan_tambah');

//JASA EKSPEDISI
/* Tabel */
Route::get('/jasa_eks', 'CommonController@jasa_eks')->name('jasa_eks');
/* Get Data */
Route::get('/jasa_eks/data', 'CommonController@jasa_eks_data');
/* Tambah */
Route::get('/jasa_eks/tambah', 'CommonController@jasa_eks_tambah');
/* Ubah */
Route::get('/jasa_eks/ubah/{id}', 'CommonController@jasa_eks_ubah');
/* Action */
Route::post('/jasa_eks/aksi_tambah', 'CommonController@jasa_eks_aksi_tambah');
Route::put('/jasa_eks/aksi_ubah/{id}', 'CommonController@jasa_eks_aksi_ubah');

//KARYAWAN PEMINJAMAN
Route::get('/karyawan/peminjaman', 'ItController@karyawan_peminjaman')->name('karyawan.peminjaman');
Route::get('/karyawan/peminjaman/show', 'ItController@karyawan_peminjaman_show')->name('karyawan.peminjaman.show');

//NAMA & ALAMAT
/* Tabel */
Route::get('/nama_alamat', 'CommonController@nama_alamat')->name('nama_alamat');
/* Get Data */
Route::get('/nama_alamat/data', 'CommonController@nama_alamat_data');
/* Tambah */
Route::get('/nama_alamat/tambah', 'CommonController@nama_alamat_tambah');
/* Ubah */
Route::get('/nama_alamat/ubah/{id}', 'CommonController@nama_alamat_ubah');
/* Action */
Route::post('/nama_alamat/aksi_tambah', 'CommonController@nama_alamat_aksi_tambah');
Route::put('/nama_alamat/aksi_ubah/{id}', 'CommonController@nama_alamat_aksi_ubah');

//PENJUALAN PRODUK
/*Tabel*/
Route::get('/penjualan_produk', 'CommonController@penjualan_produk')->name('penjualan_produk');
/* Get Data */
Route::get('/penjualan_produk/data', 'CommonController@penjualan_produk_data');
/* Tambah */
Route::get('/penjualan_produk/tambah', 'CommonController@penjualan_produk_tambah');
/* Action */
Route::post('/penjualan_produk/aksi_tambah', 'CommonController@penjualan_produk_aksi_tambah');
Route::put('/penjualan_produk/aksi_ubah/{id}', 'CommonController@penjualan_produk_aksi_ubah');
/* Cek Data */
Route::get('/penjualan_produk/cek_data/{tipe}', 'CommonController@penjualan_produk_cek_data');
/* Ubah */
Route::get('/penjualan_produk/ubah/{id}', 'CommonController@penjualan_produk_ubah');


//PENJUALAN (ONLINE)
/*Tabel*/
Route::get('/penjualan_online', 'PenjualanController@penjualan_online');
/* Get Data */
Route::get('/penjualan_online/data', 'PenjualanController@penjualan_online_data');
Route::get('/penjualan_online/detail/data/{id}', 'PenjualanController@detail_penjualan_online_data');
/* Tambah */
Route::get('/penjualan_online/tambah', 'PenjualanController@penjualan_online_tambah');
/* Ubah */
Route::get('/penjualan_online/ubah/{id}', 'PenjualanController@penjualan_online_ubah');
/* Cek Data */
Route::get('/penjualan_online/cek_data/{lkpp}', 'PenjualanController@penjualan_online_cek_data');
/* Action */
Route::post('/penjualan_online/aksi_tambah', 'PenjualanController@penjualan_online_aksi_tambah');
Route::put('/penjualan_online/aksi_ubah/{id}', 'PenjualanController@penjualan_online_aksi_ubah');
Route::put('/penjualan_online/detail/aksi_ubah', 'PenjualanController@penjualan_online_detail_aksi_ubah');
/* Detail */
Route::post('/penjualan_online/detail/aksi_tambah', 'PenjualanController@penjualan_online_detail_aksi_tambah');
Route::get('/penjualan_online/detail/data/edit/{id}', 'PenjualanController@penjualan_online_detail_edit');

//PENJUALAN ECOM (ONLINE)
/*Tabel*/
Route::get('/penjualan_online_ecom', 'PenjualanController@penjualan_online_ecom');
Route::get('/penjualan_online_ecom/tambah', 'PenjualanController@penjualan_online_ecom_tambah');
Route::get('/penjualan_online_ecom/ubah/{id}', 'PenjualanController@penjualan_online_ecom_ubah');
// Action
Route::post('/penjualan_online_ecom/aksi_tambah', 'PenjualanController@penjualan_online_ecom_aksi_tambah');
Route::put('/penjualan_online_ecom/aksi_ubah/{id}', 'PenjualanController@penjualan_online_ecom_aksi_ubah');
Route::put('/penjualan_online_ecom/detail/aksi_ubah/', 'PenjualanController@detail_penjualan_online_ecom_aksi_ubah');
/* Get Data */
Route::get('/penjualan_online_ecom/data', 'PenjualanController@penjualan_online_ecom_Data');
Route::get('/penjualan_online_ecom/detail/data/{id}', 'PenjualanController@detail_penjualan_online_ecom_data');
Route::get('/penjualan_online_ecom/detail/data/edit/{id}', 'PenjualanController@detail_penjualan_online_ecom_data_edit');

// PENJUALAN OFFLINE
/* Get Data */
Route::get('/penjualan_offline/data', 'PenjualanController@penjualan_offline_data');
Route::get('/penjualan_offline/detail/data/{id}', 'PenjualanController@detail_penjualan_offline_data');
/*Tabel*/
Route::get('/penjualan_offline', 'PenjualanController@penjualan_offline');
/* Action */
Route::post('/penjualan_offline/aksi_tambah', 'PenjualanController@penjualan_offline_aksi_tambah');
Route::put('/penjualan_offline/aksi_ubah/{id}', 'PenjualanController@penjualan_offline_aksi_ubah');
Route::put('/penjualan_offline/detail/aksi_ubah', 'PenjualanController@penjualan_offline_detail_aksi_ubah');
/* Tambah */
Route::get('/penjualan_offline/tambah', 'PenjualanController@penjualan_offline_tambah');
/*Ubah*/
Route::get('/penjualan_offline/ubah/{id}', 'PenjualanController@penjualan_offline_ubah');
/*Detail*/
Route::get('/penjualan_offline/detail/data/edit/{id}', 'PenjualanController@penjualan_offline_detail_edit');

//PENAWARAN OFFLINE
/*Table*/
Route::get('/penawaran_offline', 'PenjualanController@penawaran_offline');
/* Get Data */
Route::get('/penawaran_offline/data', 'PenjualanController@penawaran_offline_data');
/* Tambah */
Route::get('/penawaran_offline/tambah', 'PenjualanController@penawaran_offline_tambah');
/* Ubah */
Route::get('/penawaran_offline/ubah/{id}', 'PenjualanController@penawaran_offline_ubah');
/*Print*/
Route::get('/penawaran_offline/cetak_penawaran/{id}', 'PenjualanController@cetak_penawaran_offline');
/* Get Data */
Route::get('/penawaran_offline/data/{customer_id}', 'PenjualanController@penjualan_offline_data_select');
/* Action */
Route::post('/penawaran_offline/aksi_tambah', 'PenjualanController@penawaran_offline_aksi_tambah');
Route::put('/penawaran_offline/aksi_ubah/{id}', 'PenjualanController@penawaran_offline_aksi_ubah');
/*Detail*/
Route::get('/penawaran_offline/data/detail/{id}', 'PenjualanController@detail_penjualan_offline_data');

//PENAWARAN ECOM
/*Table*/
Route::get('/penawaran_ecom', 'PenjualanController@penawaran_ecom');
/* Get Data */
Route::get('/penawaran_ecom/data', 'PenjualanController@penawaran_ecom_data');
/* Tambah */
Route::get('/penawaran_ecom/tambah', 'PenjualanController@penawaran_ecom_tambah');
/* Ubah */
Route::get('/penawaran_ecom/ubah/{id}', 'PenjualanController@penawaran_ecom_ubah');
/* Get Data */
Route::get('/penawaran_ecom/data/{customer_id}', 'PenjualanController@penjualan_ecom_data_select');
/* Action */
Route::post('/penawaran_ecom/aksi_tambah', 'PenjualanController@penawaran_ecom_aksi_tambah');
Route::put('/penawaran_ecom/aksi_ubah/{id}', 'PenjualanController@penawaran_ecom_aksi_ubah');
/*Print*/
Route::get('/penawaran_ecom/cetak_penawaran/{id}', 'PenjualanController@cetak_penawaran_ecom');
/*Detail*/
Route::get('/penawaran_ecom/data/detail/{id}', 'PenjualanController@detail_penjualan_ecom_data');

//PODO EKATALOG
/*Table*/
Route::get('/podo_online', 'PenjualanController@podo_online');
/* Tambah */
Route::get('/podo_online/tambah', 'PenjualanController@podo_online_tambah');
/* Ubah */
Route::get('/podo_online/ubah/{id}', 'PenjualanController@podo_online_ubah');
/* Get Data */
Route::get('/podo_online/data/{ak1}', 'PenjualanController@podo_online_data_select');
/* Action */
Route::post('/podo_online/aksi_tambah', 'PenjualanController@podo_online_aksi_tambah');
Route::put('/podo_online/aksi_ubah/{id}', 'PenjualanController@podo_online_aksi_ubah');
/* Get Data */
Route::get('/podo_online/data', 'PenjualanController@podo_online_data');
/* File View */
Route::get('/podo_online/file{nama}', 'PenjualanController@podo_online_file');

//PODO OFFLINE
/*Table*/
Route::get('/podo_offline', 'PenjualanController@podo_offline');
/*Get Data*/
Route::get('/podo_offline/data', 'PenjualanController@podo_offline_data');
/*Tambah*/
Route::get('/podo_offline/tambah', 'PenjualanController@podo_offline_tambah');
/*Ubah*/
Route::get('/podo_offline/ubah/{id}', 'PenjualanController@podo_offline_ubah');
/*Get Data*/
Route::get('/podo_offline/data/{customer_id}', 'PenjualanController@penjualan_offline_data_select');
/*Action*/
Route::post('/podo_offline/aksi_tambah', 'PenjualanController@podo_offline_aksi_tambah');
Route::put('/podo_offline/aksi_ubah/{id}', 'PenjualanController@podo_offline_aksi_ubah');
/* File View */
Route::get('/podo_offline/file{nama}', 'PenjualanController@podo_offline_file');

//GET DATA SELECT
/* Get Data */
Route::get('/produk/get_select/{id}', 'CommonController@produk_get_select');

//PRODUK
Route::get('/produk', 'ItController@produk')->name('produk');
/* Create */
Route::get('/produk/create', 'ItController@tambah_produk')->name('produk.create');
Route::post('/produk/store', 'ItController@store_produk')->name('produk.store');
/* Edit */
Route::get('/produk/edit/{id}',  'ItController@edit_produk')->name('produk.edit');
Route::put('/produk/update/{id}',  'ItController@update_produk')->name('produk.update');
Route::put('/produk/delete/{id}', 'ItController@delete_produk')->name('produk.delete');



//INVENTORY
Route::get('/inventory/divisi', 'ItController@inventory_divisi')->name('inventory.divisi');
Route::get('/inventory/divisi/show', 'ItController@inventory_divisi_show')->name('inventory.divisi.show');
Route::get('/inventory', 'ItController@inventory')->name('inventory');
Route::get('/inventory/show/{divisi_id}', 'ItController@inventory_show')->name('inventory.show');
Route::get('/inventory_peminjaman', 'ItController@inventory_peminjaman')->name('inventory_peminjaman');
Route::get('/inventory/peminjaman/show', 'ItController@inventory_peminjaman_show')->name('inventory.peminjaman.show');
/*Create*/
Route::get('/inventory/create/{divisi_id}', 'ItController@inventory_create')->name('inventory.create');
Route::get('/inventory/kode_exist/{kode}', 'GetController@inventory_kode_exist')->name('inventory.kode.exist');
Route::put('/inventory/store/{divisi_id}', 'ItController@inventory_store')->name('inventory.store');
/*Edit*/
Route::get('/inventory/edit/{id}', 'ItController@inventory_edit')->name('inventory.edit');
Route::put('/inventory/update/{id}', 'ItController@inventory_update')->name('inventory.update');
/*Delete*/
Route::delete('/inventory/delete/{id}', 'ItController@inventory_delete')->name('inventory.delete');

//PEMINJAMAN ALAT
Route::get('/peminjaman/alat', 'ItController@peminjaman_alat')->name('peminjaman.alat');
Route::get('/peminjaman/alat/show', 'ItController@peminjaman_alat_show')->name('peminjaman.alat.show');
/*Create*/
Route::get('/peminjaman/alat/create', 'ItController@peminjaman_alat_create')->name('peminjaman.alat.create');
Route::get('/peminjaman/alat/get_inventory/{id}', 'GetController@get_inventory')->name('peminjaman.alat.get_inventory');
Route::get('/peminjaman/alat/get_inventory_detail/{id}', 'GetController@get_inventory_detail')->name('peminjaman.alat.get_inventory_detail');
Route::put('/peminjaman/alat/store/{user_id}', 'ItController@peminjaman_alat_store')->name('peminjaman.alat.store');
/*Edit*/
Route::get('/peminjaman/alat/edit/{id}', 'ItController@peminjaman_alat_edit')->name('peminjaman.alat.edit');
Route::get('/peminjaman/alat/edit/get_inventory/{id}', 'GetController@get_inventory')->name('peminjaman.alat.get_inventory');
Route::get('/peminjaman/alat/edit/get_inventory_detail/{id}', 'GetController@get_inventory_detail')->name('peminjaman.alat.get_inventory_detail');
Route::put('/peminjaman/alat/update/{id}', 'ItController@peminjaman_alat_update')->name('peminjaman.alat.update');
/*Delete*/
Route::delete('/peminjaman/alat/delete/{id}', 'ItController@peminjaman_alat_delete')->name('peminjaman.alat.delete');
/*Status*/
Route::get('/peminjaman/alat/status/{id}/{status}', 'ItController@peminjaman_alat_status')->name('peminjaman.alat.status');

//COMMON
Route::get('/template_form_delete', 'ItController@template_form_delete')->name('template_form_delete');
Route::get('/form-template', 'ItController@form_template')->name('form-template');
Route::get('/dashboard-template', 'ItController@dashboard_template')->name('dashboard-template');
Route::get('/table-template', 'ItController@table_template')->name('table-template');

//PEMINJAMAN KARYAWAN
Route::get('/peminjaman/karyawan', 'ItController@peminjaman_karyawan')->name('peminjaman.karyawan');
Route::get('/peminjaman/karyawan/show', 'ItController@peminjaman_karyawan_show')->name('peminjaman.karyawan.show');
/*Create*/
Route::get('/peminjaman/karyawan/create', 'ItController@peminjaman_karyawan_create')->name('peminjaman.karyawan.create');
Route::post('/peminjaman/karyawan/store}', 'ItController@peminjaman_karyawan_store')->name('peminjaman.karyawan.store');
/*Edit*/
Route::get('/peminjaman/karyawan/edit/{id}', 'ItController@peminjaman_karyawan_edit')->name('peminjaman.karyawan.edit');
Route::put('/peminjaman/karyawan/update/{id}', 'ItController@peminjaman_karyawan_update')->name('peminjaman.karyawan.update');
/*Delete*/
Route::delete('/peminjaman/karyawan/delete/{id}', 'ItController@peminjaman_karyawan_delete')->name('peminjaman.karyawan.delete');
/*Status*/
Route::get('/peminjaman/karyawan/status/{id}/{status}', 'ItController@peminjaman_karyawan_status')->name('peminjaman.karyawan.status');
Route::get('/peminjaman/karyawan/detail/{id}', 'ItController@peminjaman_karyawan_detail')->name('peminjaman.karyawan.detail');
Route::get('/peminjaman/karyawan/detail/show/{id}', 'ItController@peminjaman_karyawan_detail_show')->name('peminjaman.karyawan.detail.show');
Route::get('/peminjaman/karyawan/detail/edit/{id}/{karyawan_id}', 'ItController@peminjaman_karyawan_detail_edit')->name('peminjaman.karyawan.detail.edit');
Route::put('/peminjaman/karyawan/detail/update/{id}/{karyawan_id}', 'ItController@peminjaman_karyawan_detail_update')->name('peminjaman.karyawan.detail.update');
Route::get('/peminjaman/karyawan/detail/status/{id}/{karyawan_id}/{status}', 'ItController@peminjaman_karyawan_detail_status')->name('peminjaman.karyawan.detail.status');

//BPPB
Route::get('/bppb', 'PpicController@bppb')->name('bppb');
Route::get('/bppb/show', 'PpicController@bppb_show')->name('bppb.show');
/* Create */
Route::get('/bppb/create', 'PpicController@bppb_create')->name('bppb.create');
Route::get('/bppb/get_kategori_produk/{kelompok_produk_id}', 'GetController@get_kategori_produk');
Route::get('/bppb/get_produk_by_kelompok/{kelompok_produk_id}', 'GetController@get_produk_by_kelompok');
Route::get('/bppb/get_produk_by_kategori/{kategori_id}', 'GetController@get_produk_by_kategori');
Route::get('/bppb/get_kategori_by_produk/{produk_id}', 'GetController@get_kategori_by_produk');
Route::get('/bppb/get_detail_produk_id/{produk_id}', 'GetController@get_detail_produk_id');
Route::get('/bppb/get_bppb_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_produk_count_by_year');
Route::post('/bppb/store', 'PpicController@bppb_store')->name('bppb.store');
/* Edit */
Route::get('/bppb/edit/{id}', 'PpicController@bppb_edit')->name('bppb.edit');
Route::get('/bppb/edit/get_produk_by_kelompok/{kelompok_produk_id}', 'GetController@get_produk_by_kelompok');
Route::get('/bppb/edit/get_bppb_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_produk_count_by_year');
Route::put('/bppb/update/{id}', 'PpicController@bppb_update')->name('bppb.update');
/* Delete */
Route::delete('/bppb/delete/{id}', 'PpicController@bppb_delete')->name('bppb.delete');


//PERAKITAN
Route::get('/perakitan', 'ProduksiController@perakitan')->name('perakitan');
Route::get('/perakitan/show', 'ProduksiController@perakitan_show')->name('perakitan.show');
Route::get('/perakitan/laporan/{id}', 'ProduksiController@perakitan_laporan')->name('perakitan.laporan');
Route::get('/perakitan/laporan/show/{id}', 'ProduksiController@perakitan_laporan_show')->name('perakitan.laporan.show');
/* Create dari BPPB */
Route::get('/perakitan/create', 'ProduksiController@perakitan_create')->name('perakitan.create');
Route::get('/perakitan/get_bppb/{bppb_id}', 'GetController@get_bppb');
Route::get('/perakitan/get_no_seri_exist/{no_seri}', 'GetController@get_no_seri_exist');
Route::post('/perakitan/store', 'ProduksiController@perakitan_store')->name('perakitan.store');
/* Create */
Route::get('/perakitan/laporan/create/{bppb_id}', 'ProduksiController@perakitan_laporan_create')->name('perakitan.laporan.create');
Route::get('/perakitan/laporan/create/get_no_seri_exist/{no_seri}', 'GetController@get_no_seri_exist');
Route::put('/perakitan/laporan/store/{bppb_id}', 'ProduksiController@perakitan_laporan_store')->name('perakitan.laporan.store');
/* Edit */
Route::get('/perakitan/laporan/edit/{id}', 'ProduksiController@perakitan_laporan_edit')->name('perakitan.laporan.edit');
Route::get('/perakitan/laporan/edit/get_kode_perakitan_exist_not_in/{bppb}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in');
Route::get('/perakitan/laporan/edit/get_kode_perakitan_exist_not_in_id/{bppb}/{id}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in_id');
Route::put('/perakitan/laporan/update/{id}', 'ProduksiController@perakitan_laporan_update')->name('perakitan.laporan.update');
/* Delete */
Route::delete('/perakitan/laporan/delete/{id}', 'ProduksiController@perakitan_laporan_delete')->name('perakitan.laporan.delete');
//HASIL
Route::get('/perakitan/hasil/{id}', 'ProduksiController@perakitan_hasil')->name('perakitan.hasil');
/* Create */
Route::get('/perakitan/hasil/create/{id}', 'ProduksiController@perakitan_hasil_create')->name('perakitan.hasil.create');
Route::get('/perakitan/hasil/get_no_seri_exist/{no_seri}', 'GetController@get_no_seri_exist');
Route::put('/perakitan/hasil/store/{id}', 'ProduksiController@perakitan_hasil_store')->name('perakitan.hasil.store');
/* Import */
Route::put('/perakitan/hasil/import/{id}', 'ProduksiController@perakitan_hasil_import_store')->name('perakitan.hasil.import');
/* Edit */
Route::get('/perakitan/hasil/edit/{id}', 'ProduksiController@perakitan_hasil_edit')->name('perakitan.hasil.edit');
Route::get('/perakitan/hasil/edit/get_kode_perakitan_exist_not_in_id/{bppb}/{id}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in_id');
Route::put('/perakitan/hasil/update/{id}', 'ProduksiController@perakitan_hasil_update')->name('perakitan.hasil.update');
/* Delete */
Route::delete('/perakitan/hasil/delete/{id}', 'ProduksiController@perakitan_hasil_delete')->name('perakitan.hasil.delete');

//GUDANG
Route::get('/gudang', 'GudangController@index')->name('gudang');
Route::get('/gudang/data', 'GudangController@get_data')->name('gudang.data');

//PPIC
Route::get('/ppic', 'PpicController@index');
Route::post('/schedule/create', 'PpicController@calendar_create')->name('schedule.create');
Route::post('/schedule/delete', 'PpicController@calendar_delete')->name('schedule.delete');
Route::get('test', 'PpicController@test')->name('schedule.test');
