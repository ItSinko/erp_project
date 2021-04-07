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
Route::get('/penjualan_produk/data', 'CommonController@penjualan_produk_data');


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
/* Detail */
Route::get('/penjualan_online/detail/{id},');


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
Route::get('/inventory/{divisi_id}', 'ItController@inventory')->name('inventory');
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


//PEMINJAMAN KARYAWAN
Route::get('/peminjaman/karyawan', 'ItController@peminjaman_karyawan')->name('peminjaman.karyawan');
Route::get('/peminjaman/karyawan/show', 'ItController@peminjaman_karyawan_show')->name('peminjaman.karyawan.show');
/*Create*/
Route::get('/peminjaman/karyawan/create', 'ItController@peminjaman_karyawan_create')->name('peminjaman.karyawan.create');
Route::put('/peminjaman/karyawan/store/{id}', 'ItController@peminjaman_karyawan_store')->name('peminjaman.karyawan.store');
/*Edit*/
Route::get('/peminjaman/karyawan/edit', 'ItController@peminjaman_karyawan_edit')->name('peminjaman.karyawan.edit');
Route::put('/peminjaman/karyawan/update/{id}', 'ItController@peminjaman_karyawan_update')->name('peminjaman.karyawan.update');
/*Delete*/
Route::delete('/peminjaman/karyawan/delete/{id}', 'ItController@peminjaman_karyawan_delete')->name('peminjaman.karyawan.delete');
/*Status*/
Route::get('/peminjaman/karyawan/status/{id}/{status}', 'ItController@peminjaman_karyawan_status')->name('peminjaman.karyawan.status');


//BPPB
Route::get('/bppb', 'PpicController@bppb')->name('bppb');
/* Create */
Route::get('/bppb/create', 'PpicController@tambah_bppb')->name('bppb.create');
Route::get('/bppb/get_kategori_produk/{kelompok_produk_id}', 'GetController@get_kategori_produk');
Route::get('/bppb/get_produk_by_kelompok/{kelompok_produk_id}', 'GetController@get_produk_by_kelompok');
Route::get('/bppb/get_produk_by_kategori/{kategori_id}', 'GetController@get_produk_by_kategori');
Route::get('/bppb/get_kategori_by_produk/{produk_id}', 'GetController@get_kategori_by_produk');
Route::get('/bppb/get_detail_produk_id/{produk_id}', 'GetController@get_detail_produk_id');
Route::get('/bppb/get_bppb_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_produk_count_by_year');
Route::post('/bppb/store', 'PpicController@store_bppb')->name('bppb.store');
/* Edit */
Route::get('/bppb/edit/{id}', 'PpicController@edit_bppb')->name('bppb.edit');
Route::get('/bppb/edit/get_produk_by_kelompok/{kelompok_produk_id}', 'GetController@get_produk_by_kelompok');
Route::get('/bppb/edit/get_bppb_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_produk_count_by_year');
Route::put('/bppb/update/{id}', 'PpicController@update_bppb')->name('bppb.update');
/* Delete */
Route::delete('/bppb/delete/{id}', 'PpicController@delete_bppb')->name('bppb.delete');


//PERAKITAN
Route::get('/perakitan', 'ProduksiController@perakitan')->name('perakitan');

/* Create dari BPPB */
Route::get('/perakitan/create', 'ProduksiController@tambah_perakitan')->name('perakitan.create');
Route::get('/perakitan/get_bppb/{bppb_id}', 'GetController@get_bppb');
Route::get('/perakitan/get_no_seri_exist/{no_seri}', 'GetController@get_no_seri_exist');
Route::post('/perakitan/store', 'ProduksiController@store_perakitan')->name('perakitan.store');

/* Create */
Route::get('/perakitan/create_laporan/{bppb_id}', 'ProduksiController@tambah_laporan_perakitan')->name('perakitan.create_laporan');
Route::get('/perakitan/create_laporan/get_no_seri_exist/{no_seri}', 'GetController@get_no_seri_exist');
Route::put('/perakitan/store_laporan/{bppb_id}', 'ProduksiController@store_laporan_perakitan')->name('perakitan.store_laporan');

/* Edit */
Route::get('/perakitan/edit_laporan/{id}', 'ProduksiController@edit_laporan_perakitan')->name('perakitan.edit_laporan');
Route::put('/perakitan/update_laporan/{id}', 'ProduksiController@update_laporan_perakitan')->name('perakitan.update_laporan');

/* Delete */
Route::delete('/perakitan/delete_laporan/{id}', 'ProduksiController@delete_perakitan')->name('perakitan.delete_laporan');


//HASIL
Route::get('/perakitan/hasil/{id}', 'ProduksiController@hasil_perakitan')->name('perakitan.hasil');

/* Create */
Route::get('/perakitan/hasil/create/{id}', 'ProduksiController@tambah_hasil_perakitan')->name('perakitan.hasil.create');
Route::get('/perakitan/hasil/get_no_seri_exist/{no_seri}', 'GetController@get_no_seri_exist');
Route::put('/perakitan/hasil/store/{id}', 'ProduksiController@store_hasil_perakitan')->name('perakitan.hasil.store');

/* Import */
Route::put('/perakitan/hasil/import/{id}', 'ProduksiController@store_hasil_perakitan_import')->name('perakitan.hasil.import');

/* Edit */
Route::get('/perakitan/hasil/edit/{id}', 'ProduksiController@edit_hasil_perakitan')->name('perakitan.hasil.edit');
Route::put('/perakitan/hasil/update/{id}', 'ProduksiController@update_hasil_perakitan')->name('perakitan.hasil.update');

/* Delete */
Route::delete('/perakitan/hasil/delete/{id}', 'ProduksiController@delete_hasil_perakitan')->name('perakitan.hasil.delete');

//GUDANG
Route::get('/gudang', 'GudangController@index')->name('gudang');
Route::get('/gudang/data', 'GudangController@get_data')->name('gudang.data');

//PPIC
Route::get('/ppic', 'PpicController@index');
