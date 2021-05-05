<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\GetController;
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

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


//COMMON
Route::group(['middleware' => 'auth'], function () {
    Route::get('/form-template', 'ItController@form_template')->name('form-template');
});


//Karyawan
Route::group(['prefix' => '/karyawan', 'middleware' => 'auth'], function () {
    Route::get('/', 'CommonController@karyawan');   /* Tabel */
    Route::get('/tambah', 'CommonController@karyawan_tambah');
    //KARYAWAN PEMINJAMAN
    Route::get('/peminjaman', 'ItController@karyawan_peminjaman')->name('karyawan.peminjaman');
    Route::get('/peminjaman/show', 'ItController@karyawan_peminjaman_show')->name('karyawan.peminjaman.show');
});
//Kesehatan
/* Tabel */
Route::get('/kesehatan', 'KesehatanController@kesehatan');
/* Tambah */
Route::get('/kesehatan/tambah', 'KesehatanController@kesehatan_tambah');
Route::post('/kesehatan/aksi_tambah', 'KesehatanController@kesehatan_aksi_tambah');
/* Ubah */
Route::get('/kesehatan/ubah/{id}', 'KesehatanController@kesehatan_ubah');
/* Get Data */
Route::get('/kesehatan/data', 'KesehatanController@kesehatan_data');
Route::get('/kesehatan/detail', 'KesehatanController@kesehatan_detail');


//Kesehatan Harian
/* Tabel */
Route::get('/kesehatan_harian', 'KesehatanController@kesehatan_harian');
Route::get('/kesehatan_harian/detail', 'KesehatanController@kesehatan_harian_detail');
/* Tambah */
Route::get('/kesehatan_harian/tambah', 'KesehatanController@kesehatan_harian_tambah');
Route::post('/kesehatan_harian/aksi_tambah', 'KesehatanController@kesehatan_harian_aksi_tambah');
Route::put('/kesehatan_harian/aksi_ubah', 'KesehatanController@kesehatan_harian_aksi_ubah');
/* Get Data */
Route::get('/kesehatan_harian/data', 'KesehatanController@kesehatan_harian_data');
Route::get('/kesehatan_harian/data/karyawan/{id}', 'KesehatanController@kesehatan_harian_detail_data_karyawan');
Route::get('/kesehatan_harian/tambah/data/{id}', 'KesehatanController@kesehatan_harian_tambah_data');
Route::get('/kesehatan_harian/detail/{id}', 'KesehatanController@kesehatan_harian_detail_data');


//JASA EKSPEDISI
Route::group(['prefix' => '/jasa_eks', 'middleware' => 'auth'], function () {
    Route::get('', 'CommonController@jasa_eks')->name('jasa_eks'); /* Tabel */
    Route::get('/data', 'CommonController@jasa_eks_data'); /* Get Data */
    Route::get('/tambah', 'CommonController@jasa_eks_tambah'); /* Tambah */
    Route::get('/ubah/{id}', 'CommonController@jasa_eks_ubah');    /* Ubah */
    Route::post('/aksi_tambah', 'CommonController@jasa_eks_aksi_tambah');  /* Action */
    Route::put('/aksi_ubah/{id}', 'CommonController@jasa_eks_aksi_ubah');
});

//NAMA & ALAMAT
Route::group(['prefix' => '/nama_alamat', 'middleware' => 'auth'], function () {
    Route::get('', 'CommonController@nama_alamat')->name('nama_alamat');    /* Tabel */
    Route::get('/data', 'CommonController@nama_alamat_data');   /* Get Data */
    Route::get('/tambah', 'CommonController@nama_alamat_tambah');   /* Tambah */
    Route::get('/ubah/{id}', 'CommonController@nama_alamat_ubah');  /* Ubah */
    Route::post('/aksi_tambah', 'CommonController@nama_alamat_aksi_tambah');    /* Action */
    Route::put('/aksi_ubah/{id}', 'CommonController@nama_alamat_aksi_ubah');
});


//PENJUALAN PRODUK
Route::group(['prefix' => '/penjualan_produk', 'middleware' => 'auth'], function () {
    Route::get('/', 'CommonController@penjualan_produk')->name('penjualan_produk'); /*Tabel*/
    Route::get('/data', 'CommonController@penjualan_produk_data'); /* Get Data */
    Route::get('/tambah', 'CommonController@penjualan_produk_tambah'); /* Tambah */
    Route::post('/aksi_tambah', 'CommonController@penjualan_produk_aksi_tambah');  /* Action */
    Route::put('/aksi_ubah/{id}', 'CommonController@penjualan_produk_aksi_ubah');
    Route::get('/cek_data/{tipe}', 'CommonController@penjualan_produk_cek_data');  /* Cek Data */
    Route::get('/ubah/{id}', 'CommonController@penjualan_produk_ubah');    /* Ubah */
});


//PENJUALAN (ONLINE)
Route::group(['prefix' => '/penjualan_online', 'middleware' => 'auth'], function () {
    Route::get('/', 'PenjualanController@penjualan_online');    /*Tabel*/
    Route::get('/data', 'PenjualanController@penjualan_online_data');  /* Get Data */
    Route::get('/detail/data/{id}', 'PenjualanController@detail_penjualan_online_data');
    Route::get('/tambah', 'PenjualanController@penjualan_online_tambah');  /* Tambah */
    Route::get('/ubah/{id}', 'PenjualanController@penjualan_online_ubah'); /* Ubah */
    Route::get('/cek_data/{lkpp}', 'PenjualanController@penjualan_online_cek_data');   /* Cek Data */
    Route::post('/aksi_tambah', 'PenjualanController@penjualan_online_aksi_tambah');   /* Action */
    Route::put('/aksi_ubah/{id}', 'PenjualanController@penjualan_online_aksi_ubah');
    Route::put('/detail/aksi_ubah', 'PenjualanController@penjualan_online_detail_aksi_ubah');
    Route::post('/detail/aksi_tambah', 'PenjualanController@penjualan_online_detail_aksi_tambah'); /* Detail */
    Route::get('/detail/data/edit/{id}', 'PenjualanController@penjualan_online_detail_edit');
});


//PENJUALAN ECOM (ONLINE)
Route::group(['prefix' => '/penjualan_online_ecom', 'middleware' => 'auth'], function () {
    Route::get('/', 'PenjualanController@penjualan_online_ecom');  /*Tabel*/
    Route::get('/tambah', 'PenjualanController@penjualan_online_ecom_tambah');
    Route::get('/ubah/{id}', 'PenjualanController@penjualan_online_ecom_ubah');
    Route::post('/aksi_tambah', 'PenjualanController@penjualan_online_ecom_aksi_tambah'); // Action
    Route::put('/aksi_ubah/{id}', 'PenjualanController@penjualan_online_ecom_aksi_ubah');
    Route::put('/detail/aksi_ubah/', 'PenjualanController@detail_penjualan_online_ecom_aksi_ubah');
    Route::get('/data', 'PenjualanController@penjualan_online_ecom_Data');    /* Get Data */
    Route::get('/detail/data/{id}', 'PenjualanController@detail_penjualan_online_ecom_data');
    Route::get('/detail/data/edit/{id}', 'PenjualanController@detail_penjualan_online_ecom_data_edit');
});


// PENJUALAN OFFLINE
Route::group(['prefix' => '/penjualan_offline', 'middleware' => 'auth'], function () {
    Route::get('/data', 'PenjualanController@penjualan_offline_data');    /* Get Data */
    Route::get('/detail/data/{id}', 'PenjualanController@detail_penjualan_offline_data');
    Route::get('/', 'PenjualanController@penjualan_offline');  /*Tabel*/
    Route::post('/aksi_tambah', 'PenjualanController@penjualan_offline_aksi_tambah'); /* Action */
    Route::put('/aksi_ubah/{id}', 'PenjualanController@penjualan_offline_aksi_ubah');
    Route::put('/detail/aksi_ubah', 'PenjualanController@penjualan_offline_detail_aksi_ubah');
    Route::get('/tambah', 'PenjualanController@penjualan_offline_tambah');    /* Tambah */
    Route::get('/ubah/{id}', 'PenjualanController@penjualan_offline_ubah');   /*Ubah*/
    Route::get('/detail/data/edit/{id}', 'PenjualanController@penjualan_offline_detail_edit');    /*Detail*/
});


//PENAWARAN OFFLINE
Route::group(['prefix' => '/penawaran_offline', 'middleware' => 'auth'], function () {
    Route::get('/', 'PenjualanController@penawaran_offline');  /*Table*/
    Route::get('/data', 'PenjualanController@penawaran_offline_data');    /* Get Data */
    Route::get('/tambah', 'PenjualanController@penawaran_offline_tambah');    /* Tambah */
    Route::get('/ubah/{id}', 'PenjualanController@penawaran_offline_ubah');   /* Ubah */
    Route::get('/cetak_penawaran/{id}', 'PenjualanController@cetak_penawaran_offline');   /*Print*/
    Route::get('/data/{customer_id}', 'PenjualanController@penjualan_offline_data_select');   /* Get Data */
    Route::post('/aksi_tambah', 'PenjualanController@penawaran_offline_aksi_tambah'); /* Action */
    Route::put('/aksi_ubah/{id}', 'PenjualanController@penawaran_offline_aksi_ubah');
    Route::get('/data/detail/{id}', 'PenjualanController@detail_penjualan_offline_data'); /*Detail*/
});


//PENAWARAN ECOM
Route::group(['prefix' => '/penawaran_ecom', 'middleware' => 'auth'], function () {
    Route::get('/', 'PenjualanController@penawaran_ecom');    /*Table*/
    Route::get('/data', 'PenjualanController@penawaran_ecom_data');  /* Get Data */
    Route::get('/tambah', 'PenjualanController@penawaran_ecom_tambah');  /* Tambah */
    Route::get('/ubah/{id}', 'PenjualanController@penawaran_ecom_ubah'); /* Ubah */
    Route::get('/data/{customer_id}', 'PenjualanController@penjualan_ecom_data_select'); /* Get Data */
    Route::post('/aksi_tambah', 'PenjualanController@penawaran_ecom_aksi_tambah');   /* Action */
    Route::put('/aksi_ubah/{id}', 'PenjualanController@penawaran_ecom_aksi_ubah');
    Route::get('/cetak_penawaran/{id}', 'PenjualanController@cetak_penawaran_ecom'); /*Print*/
    Route::get('/data/detail/{id}', 'PenjualanController@detail_penjualan_ecom_data');   /*Detail*/
});


//PODO EKATALOG
Route::group(['prefix' => '/podo_online', 'middleware' => 'auth'], function () {
    Route::get('/', 'PenjualanController@podo_online');  /*Table*/
    Route::get('/tambah', 'PenjualanController@podo_online_tambah');    /* Tambah */
    Route::get('/ubah/{id}', 'PenjualanController@podo_online_ubah');   /* Ubah */
    Route::get('/data/{ak1}', 'PenjualanController@podo_online_data_select');   /* Get Data */
    Route::post('/aksi_tambah', 'PenjualanController@podo_online_aksi_tambah'); /* Action */
    Route::put('/aksi_ubah/{id}', 'PenjualanController@podo_online_aksi_ubah');
    Route::get('/data', 'PenjualanController@podo_online_data');    /* Get Data */
    Route::get('/file{nama}', 'PenjualanController@podo_online_file');  /* File View */
});


//PODO OFFLINE
Route::group(['prefix' => '/podo_offline', 'middleware' => 'auth'], function () {
    Route::get('/', 'PenjualanController@podo_offline');    /*Table*/
    Route::get('/data', 'PenjualanController@podo_offline_data');  /*Get Data*/
    Route::get('/tambah', 'PenjualanController@podo_offline_tambah');  /*Tambah*/
    Route::get('/ubah/{id}', 'PenjualanController@podo_offline_ubah'); /*Ubah*/
    Route::get('/data/{customer_id}', 'PenjualanController@penjualan_offline_data_select');    /*Get Data*/
    Route::post('/aksi_tambah', 'PenjualanController@podo_offline_aksi_tambah');   /*Action*/
    Route::put('/aksi_ubah/{id}', 'PenjualanController@podo_offline_aksi_ubah');
    Route::get('/file{nama}', 'PenjualanController@podo_offline_file');    /* File View */
});


//GET DATA SELECT
Route::group(['prefix' => '/produk', 'middleware' => 'auth'], function () {
    Route::get('/get_select/{id}', 'CommonController@produk_get_select');    /* Get Data */
    Route::get('/', 'ItController@produk')->name('produk');
    Route::get('/show', 'ItController@produk_show')->name('produk.show');
    Route::get('/create', 'ItController@produk_create')->name('produk.create');  /* Create */
    Route::get('/create/get_kategori_produk_by_kelompok_produk/{kelompok_produk_id}', 'GetController@get_kategori_produk_by_kelompok_produk');
    Route::get('/create/get_tipe_produk_exist/{kelompok_produk_id}', 'GetController@get_tipe_produk_exist');
    Route::post('/store', 'ItController@produk_store')->name('produk.store');
    Route::get('/edit/{id}',  'ItController@produk_edit')->name('produk.edit');  /* Edit */
    Route::put('/update/{id}',  'ItController@produk_update')->name('produk.update');
    Route::put('/delete/{id}', 'ItController@produk_delete')->name('produk.delete');
    Route::get('/detail', 'ItController@produk_detail')->name('produk.detail');  /* Detail */
    Route::get('/detail/show/{id}', 'ItController@produk_detail_show')->name('produk.detail.show');
});

//INVENTORY
Route::group(['prefix' => '/inventory', 'middleware' => 'auth'], function () {
    Route::get('/divisi', 'ItController@inventory_divisi')->name('inventory.divisi');
    Route::get('/divisi/show', 'ItController@inventory_divisi_show')->name('inventory.divisi.show');
    Route::get('/', 'ItController@inventory')->name('inventory');
    Route::get('/show/{divisi_id}', 'ItController@inventory_show')->name('inventory.show');
    Route::get('_peminjaman', 'ItController@inventory_peminjaman')->name('inventory_peminjaman');
    Route::get('/peminjaman/show', 'ItController@inventory_peminjaman_show')->name('inventory.peminjaman.show');
    Route::get('/create/{divisi_id}', 'ItController@inventory_create')->name('inventory.create'); /*Create*/
    Route::get('/kode_exist/{kode}', 'GetController@inventory_kode_exist')->name('inventory.kode.exist');
    Route::put('/store/{divisi_id}', 'ItController@inventory_store')->name('inventory.store');
    Route::get('/edit/{id}', 'ItController@inventory_edit')->name('inventory.edit');  /*Edit*/
    Route::put('/update/{id}', 'ItController@inventory_update')->name('inventory.update');
    Route::delete('/delete/{id}', 'ItController@inventory_delete')->name('inventory.delete'); /*Delete*/
});


//PEMINJAMAN
Route::group(['prefix' => '/peminjaman', 'middleware' => 'auth'], function () {
    // ALAT
    Route::group(['prefix' => '/alat'], function () {
        Route::get('/', 'ItController@peminjaman_alat')->name('peminjaman.alat');
        Route::get('/show', 'ItController@peminjaman_alat_show')->name('peminjaman.alat.show');
        Route::get('/create', 'ItController@peminjaman_alat_create')->name('peminjaman.alat.create');   /*Create*/
        Route::get('/get_inventory/{id}', 'GetController@get_inventory')->name('peminjaman.alat.get_inventory');
        Route::get('/get_inventory_detail/{id}', 'GetController@get_inventory_detail')->name('peminjaman.alat.get_inventory_detail');
        Route::put('/store/{user_id}', 'ItController@peminjaman_alat_store')->name('peminjaman.alat.store');
        Route::get('/edit/{id}', 'ItController@peminjaman_alat_edit')->name('peminjaman.alat.edit');    /*Edit*/
        Route::get('/edit/get_inventory/{id}', 'GetController@get_inventory')->name('peminjaman.alat.get_inventory');
        Route::get('/edit/get_inventory_detail/{id}', 'GetController@get_inventory_detail')->name('peminjaman.alat.get_inventory_detail');
        Route::put('/update/{id}', 'ItController@peminjaman_alat_update')->name('peminjaman.alat.update');
        Route::delete('/delete/{id}', 'ItController@peminjaman_alat_delete')->name('peminjaman.alat.delete');   /*Delete*/
        Route::get('/status/{id}/{status}', 'ItController@peminjaman_alat_status')->name('peminjaman.alat.status'); /*Status*/
    });

    // KARYAWAN
    Route::group(['prefix' => '/karyawan'], function () {
        Route::get('/', 'ItController@peminjaman_karyawan')->name('peminjaman.karyawan');
        Route::get('/show', 'ItController@peminjaman_karyawan_show')->name('peminjaman.karyawan.show');
        Route::get('/create', 'ItController@peminjaman_karyawan_create')->name('peminjaman.karyawan.create');   /*Create*/
        Route::post('/store}', 'ItController@peminjaman_karyawan_store')->name('peminjaman.karyawan.store');
        Route::get('/edit/{id}', 'ItController@peminjaman_karyawan_edit')->name('peminjaman.karyawan.edit');    /*Edit*/
        Route::put('/update/{id}', 'ItController@peminjaman_karyawan_update')->name('peminjaman.karyawan.update');
        Route::delete('/delete/{id}', 'ItController@peminjaman_karyawan_delete')->name('peminjaman.karyawan.delete');   /*Delete*/
        Route::get('/status/{id}/{status}', 'ItController@peminjaman_karyawan_status')->name('peminjaman.karyawan.status'); /*Status*/
        Route::get('/detail/{id}', 'ItController@peminjaman_karyawan_detail')->name('peminjaman.karyawan.detail');
        Route::get('/detail/show/{id}', 'ItController@peminjaman_karyawan_detail_show')->name('peminjaman.karyawan.detail.show');
        Route::get('/detail/edit/{id}/{karyawan_id}', 'ItController@peminjaman_karyawan_detail_edit')->name('peminjaman.karyawan.detail.edit');
        Route::put('/detail/update/{id}/{karyawan_id}', 'ItController@peminjaman_karyawan_detail_update')->name('peminjaman.karyawan.detail.update');
        Route::get('/detail/status/{id}/{karyawan_id}/{status}', 'ItController@peminjaman_karyawan_detail_status')->name('peminjaman.karyawan.detail.status');
    });
});


//BPPB
Route::group(['prefix' => '/bppb', 'middleware' => 'auth'], function () {
    Route::get('/', 'PpicController@bppb')->name('bppb');
    Route::get('/show', 'PpicController@bppb_show')->name('bppb.show');
    Route::get('/create', 'PpicController@bppb_create')->name('bppb.create');  /* Create */
    Route::get('/create/get_detail_produk_by_kelompok_produk/{kelompok_produk_id}', 'GetController@get_detail_produk_by_kelompok_produk');
    Route::get('/create/get_detail_produk_by_id/{id}', 'GetController@get_detail_produk_by_id');
    Route::get('/create/get_bppb_detail_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_detail_produk_count_by_year');
    Route::get('/get_bppb_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_produk_count_by_year');
    Route::post('/store', 'PpicController@bppb_store')->name('bppb.store');
    Route::get('/edit/{id}', 'PpicController@bppb_edit')->name('bppb.edit');   /* Edit */
    Route::get('/edit/get_detail_produk_by_kelompok_produk/{kelompok_produk_id}', 'GetController@get_detail_produk_by_kelompok_produk');
    Route::get('/edit/get_detail_produk_by_id/{id}', 'GetController@get_detail_produk_by_id');
    Route::get('/edit/get_bppb_detail_produk_count_by_year/{tahun}/{produk_id}', 'GetController@get_bppb_detail_produk_count_by_year');
    Route::put('/update/{id}', 'PpicController@bppb_update')->name('bppb.update');
    Route::delete('/delete/{id}', 'PpicController@bppb_delete')->name('bppb.delete');  /* Delete */
});


//PERAKITAN
Route::group(['prefix' => '/perakitan', 'middleware' => 'auth'], function () {
    Route::get('/', 'ProduksiController@perakitan')->name('perakitan');
    Route::get('/show', 'ProduksiController@perakitan_show')->name('perakitan.show');
    Route::get('/create', 'ProduksiController@perakitan_create')->name('perakitan.create');   /* Create dari BPPB */
    Route::get('/create/get_bppb/{bppb_id}', 'GetController@get_bppb');
    Route::get('/create/get_kode_perakitan_exist_not_in/{bppb}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in');
    Route::post('/store', 'ProduksiController@perakitan_store')->name('perakitan.store');

    // LAPORAN
    Route::group(['prefix' => '/laporan'], function () {
        Route::get('/{id}', 'ProduksiController@perakitan_laporan')->name('perakitan.laporan');
        Route::get('/show/{id}', 'ProduksiController@perakitan_laporan_show')->name('perakitan.laporan.show');
        Route::get('/create/{bppb_id}', 'ProduksiController@perakitan_laporan_create')->name('perakitan.laporan.create');   /* Create */
        Route::get('/create/get_kode_perakitan_exist_not_in/{bppb}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in');
        Route::put('/store/{bppb_id}', 'ProduksiController@perakitan_laporan_store')->name('perakitan.laporan.store');
        Route::get('/edit/{id}', 'ProduksiController@perakitan_laporan_edit')->name('perakitan.laporan.edit');  /* Edit */
        Route::get('/edit/get_kode_perakitan_exist_not_in/{bppb}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in');
        Route::get('/edit/get_kode_perakitan_exist_not_in_id/{bppb}/{id}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in_id');
        Route::put('/update/{id}', 'ProduksiController@perakitan_laporan_update')->name('perakitan.laporan.update');
        Route::delete('/delete/{id}', 'ProduksiController@perakitan_laporan_delete')->name('perakitan.laporan.delete'); /* Delete */
        Route::get('/status/{id}/{status}', 'ProduksiController@perakitan_laporan_status')->name('perakitan.laporan.status');   /* Status */
    });

    //HASIL
    Route::group(['prefix' => '/hasil'], function () {
        Route::get('/{id}', 'ProduksiController@perakitan_hasil')->name('perakitan.hasil');
        Route::get('/show/{id}', 'ProduksiController@perakitan_hasil_show')->name('perakitan.hasil.show');
        Route::get('/create/{id}', 'ProduksiController@perakitan_hasil_create')->name('perakitan.hasil.create');    /* Create */
        Route::get('/create/get_kode_perakitan_exist_not_in/{bppb}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in');
        Route::put('/store/{id}', 'ProduksiController@perakitan_hasil_store')->name('perakitan.hasil.store');
        Route::put('/import/{id}', 'ProduksiController@perakitan_hasil_import_store')->name('perakitan.hasil.import');  /* Import */
        Route::get('/edit/{id}', 'ProduksiController@perakitan_hasil_edit')->name('perakitan.hasil.edit');  /* Edit */
        Route::get('/edit/get_kode_perakitan_exist_not_in_id/{bppb}/{id}/{no_seri}', 'GetController@get_kode_perakitan_exist_not_in_id');
        Route::put('/update/{id}', 'ProduksiController@perakitan_hasil_update')->name('perakitan.hasil.update');
        Route::delete('/delete/{id}', 'ProduksiController@perakitan_hasil_delete')->name('perakitan.hasil.delete'); /* Delete */
        Route::get('/status/{id}/{status}', 'ProduksiController@perakitan_hasil_status')->name('perakitan.hasil.status');   /* Status */
    });

    //PEMERIKSAAN
    Route::group(['prefix' => '/pemeriksaan'], function () {
        Route::get('', 'QCController@perakitan_pemeriksaan')->name('perakitan.pemeriksaan');
        Route::get('/show', 'QCController@perakitan_pemeriksaan_show')->name('perakitan.pemeriksaan.show');
        Route::get('/laporan', 'QCController@perakitan_pemeriksaan_laporan')->name('perakitan.pemeriksaan.laporan');
        Route::get('/laporan/show/{id}', 'QCController@perakitan_pemeriksaan_laporan_show')->name('perakitan.pemeriksaan.laporan.show');
        /* Edit */
        Route::get('/terbuka/edit/{id}', 'QCController@perakitan_pemeriksaan_terbuka_edit')->name('perakitan.pemeriksaan.terbuka.edit');
        Route::put('/terbuka/update/{id}', 'QCController@perakitan_pemeriksaan_terbuka_update')->name('perakitan.pemeriksaan.terbuka.update');
        Route::get('/tertutup/edit/{id}', 'QCController@perakitan_pemeriksaan_tertutup_edit')->name('perakitan.pemeriksaan.tertutup.edit');
        Route::put('/tertutup/update/{id}', 'QCController@perakitan_pemeriksaan_tertutup_update')->name('perakitan.pemeriksaan.tertutup.update');
        /* Hasil */
        Route::get('/hasil/{id}', 'QCController@perakitan_pemeriksaan_hasil')->name('perakitan.pemeriksaan.hasil');
        Route::get('/hasil/show/{id}', 'QCController@perakitan_pemeriksaan_hasil_show')->name('perakitan.pemeriksaan.hasil.show');
        Route::get('/hasil/detail/{id}', 'QCController@perakitan_pemeriksaan_hasil_detail')->name('perakitan.pemeriksaan.hasil.detail');
        /* BPPB */
        Route::get('/bppb/{id}', 'QCController@perakitan_pemeriksaan_bppb')->name('perakitan.pemeriksaan.bppb');
        Route::get('/bppb/show/{id}', 'QCController@perakitan_pemeriksaan_bppb_show')->name('perakitan.pemeriksaan.bppb.show');
    });
});

//PENGUJIAN
Route::get('/pengujian', 'QCController@pengujian')->name('pengujian');
Route::get('/pengujian/show', 'QCController@pengujian_show')->name('pengujian.show');
Route::get('/pengujian/monitoring_proses/show/{bppb_id}', 'QCController@pengujian_monitoring_proses_show')->name('pengujian.monitoring_proses.show');
Route::get('/pengujian/monitoring_proses/create/{bppb_id}', 'QCController@pengujian_monitoring_proses_create')->name('pengujian.monitoring_proses.create');
Route::put('/pengujian/monitoring_proses/store/{bppb_id}', 'QCController@pengujian_monitoring_proses_store')->name('pengujian.monitoring_proses.store');
Route::get('/pengujian/monitoring_proses/laporan/edit/{id}', 'QCController@pengujian_monitoring_proses_edit')->name('pengujian.monitoring_proses.edit');
Route::put('/pengujian/monitoring_proses/laporan/update/{id}', 'QCController@pengujian_monitoring_proses_update')->name('pengujian.monitoring_proses.update');

//PENGEMASAN
Route::group(['prefix' => '/pengemasan', 'middleware' => 'auth'], function () {
    Route::get('/', 'ProduksiController@pengemasan')->name('pengemasan');
    Route::get('/show', 'ProduksiController@pengemasan_show')->name('pengemasan.show');
    Route::get('/laporan/{id}', 'ProduksiController@pengemasan_laporan')->name('pengemasan.laporan');
    Route::get('/laporan/show/{id}', 'ProduksiController@pengemasan_laporan_show')->name('pengemasan.laporan.show');
});


// DOCUMENT CONTROL
Route::group(['prefix' => 'dc', 'middleware' => 'auth'], function () {
    Route::get('/', 'dc_controller\HomeController@index')->name('dc.dashboard');
    Route::resource('/documents', 'dc_controller\DocumentController');
    Route::get('/eng', 'dc_controller\DocumentController@eng');
});

// ARI Controller Temporary
//GUDANG
Route::get('/gudang', 'GudangController@index')->name('gudang');
Route::get('/gudang/data', 'GudangController@get_data')->name('gudang.data');


//PPIC
Route::get('/ppic', 'PpicController@index');
Route::post('/schedule/create', 'PpicController@calendar_create')->name('schedule.create');
Route::post('/schedule/delete', 'PpicController@calendar_delete')->name('schedule.delete');
Route::get('test', 'PpicController@test')->name('schedule.test');

// Eng
Route::view('/eng', 'page.engineering.index');
Route::get('/eng/index', 'EngController@test');
Route::get('/show_list/{produk?}/{document?}', 'EngController@show_list');
Route::post('/eng/fileupload', 'EngController@fileupload')->name('eng.fileupload');
Route::get('test_spa', 'EngController@index');


Route::get('/chat', 'ChatController@index');
Route::get('/message', 'ChatController@fetchMessages');
Route::post('/message', 'ChatController@sendMessage');
