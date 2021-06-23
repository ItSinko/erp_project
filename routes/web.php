<?php

use App\Event;
use App\Events\cek_stok;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\QCController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    Route::get('/template_form_delete', 'ItController@template_form_delete')->name('template-form-delete');
    Route::get('/template_form_cancel', 'ItController@template_form_cancel')->name('template-form-cancel');
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
Route::get('/kesehatan/data/{karyawan_id}', 'KesehatanController@kesehatan_data_detail');
Route::get('/kesehatan/detail/', 'KesehatanController@kesehatan_detail');

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

//Kesehatan Mingguan
Route::get('/kesehatan_mingguan', 'KesehatanController@kesehatan_mingguan');
/* Tambah */
Route::get('/kesehatan_mingguan/tambah', 'KesehatanController@kesehatan_mingguan_tambah');
Route::post('/kesehatan_mingguan_tensi/aksi_tambah', 'KesehatanController@kesehatan_mingguan_tensi_aksi_tambah');
Route::put('/kesehatan_mingguan_tensi/aksi_ubah', 'KesehatanController@kesehatan_mingguan_tensi_aksi_ubah');
Route::put('/kesehatan_mingguan_rapid/aksi_ubah', 'KesehatanController@kesehatan_mingguan_rapid_aksi_ubah');
Route::post('/kesehatan_mingguan_rapid/aksi_tambah', 'KesehatanController@kesehatan_mingguan_rapid_aksi_tambah');
/* Get Data */
Route::get('/kesehatan_mingguan_tensi/data', 'KesehatanController@kesehatan_mingguan_tensi_data');
Route::get('/kesehatan_mingguan_rapid/data', 'KesehatanController@kesehatan_mingguan_rapid_data');
/* Get Detail */
Route::get('/kesehatan_mingguan/detail', 'KesehatanController@kesehatan_mingguan_detail');
Route::get('/kesehatan_mingguan_tensi/detail/{karyawan_id}', 'KesehatanController@kesehatan_mingguan_tensi_detail_data');
Route::get('/kesehatan_mingguan_rapid/detail/{karyawan_id}', 'KesehatanController@kesehatan_mingguan_rapid_detail_data');
Route::get('/kesehatan_mingguan_tensi/detail/data/{karyawan_id}', 'KesehatanController@kesehatan_mingguan_tensi_detail_data_karyawan');

//Kesehatan Bulanan
Route::get('/kesehatan_bulanan', 'KesehatanController@kesehatan_bulanan');
Route::get('/kesehatan_bulanan/tambah', 'KesehatanController@kesehatan_bulanan_tambah');
Route::get('/kesehatan_bulanan/tambah/data', 'KesehatanController@kesehatan_bulanan_tambah_data');
Route::post('/kesehatan_bulanan_gcu/aksi_tambah', 'KesehatanController@kesehatan_bulanan_gcu_aksi_tambah');
Route::post('/kesehatan_bulanan_berat/aksi_tambah', 'KesehatanController@kesehatan_bulanan_berat_aksi_tambah');
Route::put('/kesehatan_bulanan_berat/aksi_ubah', 'KesehatanController@kesehatan_bulanan_berat_aksi_ubah');
Route::put('/kesehatan_bulanan_gcu/aksi_ubah', 'KesehatanController@kesehatan_bulanan_gcu_aksi_ubah');
Route::get('/kesehatan_bulanan_gcu/data', 'KesehatanController@kesehatan_bulanan_gcu_data');
Route::get('/kesehatan_bulanan_berat/data', 'KesehatanController@kesehatan_bulanan_berat_data');
Route::get('/kesehatan_bulanan/detail', 'KesehatanController@kesehatan_bulanan_gcu_detail');
Route::get('/kesehatan_bulanan_berat/detail/{karyawan_id}', 'KesehatanController@kesehatan_bulanan_berat_detail_data');
Route::get('/kesehatan_bulanan_gcu/detail/{karyawan_id}', 'KesehatanController@kesehatan_bulanan_gcu_detail_data');
Route::get('/kesehatan_bulanan/detail/data/{karyawan_id}', 'KesehatanController@kesehatan_bulanan_detail_data_karyawan');

//Kesehatan Tahunan
Route::get('/kesehatan_tahunan', 'KesehatanController@kesehatan_tahunan');
Route::get('/kesehatan_tahunan/data', 'KesehatanController@kesehatan_tahunan_data');
Route::get('/kesehatan_tahunan/detail/{karyawan_id}', 'KesehatanController@kesehatan_tahunan_detail_karyawan');
Route::get('/kesehatan_tahunan/detail/data/{karyawan_id}', 'KesehatanController@kesehatan_tahunan_detail_data_karyawan');
Route::get('/kesehatan_tahunan/detail', 'KesehatanController@kesehatan_tahunan_detail');
Route::get('/kesehatan_tahunan/tambah', 'KesehatanController@kesehatan_tahunan_tambah');
Route::post('/kesehatan_tahunan/aksi_tambah', 'KesehatanController@kesehatan_tahunan_aksi_tambah');
Route::put('/kesehatan_tahunan/aksi_ubah', 'KesehatanController@kesehatan_tahunan_aksi_ubah');

//Karyawan Sakit
Route::get('/karyawan_sakit', 'KesehatanController@karyawan_sakit');
Route::get('/karyawan_sakit/data', 'KesehatanController@karyawan_sakit_data');
Route::get('/karyawan_sakit/tambah', 'KesehatanController@karyawan_sakit_tambah');
Route::get('/karyawan_sakit/obat/data/', 'KesehatanController@obat_data');
Route::post('/karyawan_sakit/aksi_tambah', 'KesehatanController@karyawan_sakit_aksi_tambah');

//Karyawan Masuk
Route::get('/karyawan_masuk', 'KesehatanController@karyawan_masuk');
Route::get('/karyawan_masuk/data', 'KesehatanController@karyawan_masuk_data');
Route::get('/karyawan_masuk/tambah', 'KesehatanController@karyawan_masuk_tambah');
Route::post('/karyawan_masuk/aksi_tambah', 'KesehatanController@karyawan_masuk_aksi_tambah');
Route::get('/karyawan_masuk/detail/data/{id}', 'KesehatanController@karyawan_masuk_detail_data');

//Obat
Route::get('/obat', 'KesehatanController@obat');
Route::get('/obat/data', 'KesehatanController@obat_data');
Route::get('/obat/data/{id}', 'KesehatanController@obat_data_id');
Route::get('/obat/detail/data/{id}', 'KesehatanController@obat_detail_data');
Route::get('/obat/tambah', 'KesehatanController@obat_tambah');
Route::post('/obat/aksi_tambah', 'KesehatanController@obat_aksi_tambah');

//Laporan
Route::get('/laporan_harian', 'KesehatanController@laporan_harian');
Route::get('/laporan_mingguan', 'KesehatanController@laporan_mingguan');
Route::get('/laporan_bulanan', 'KesehatanController@laporan_bulanan');
Route::get('/laporan_tahunan', 'KesehatanController@laporan_tahunan');
Route::get('/laporan_harian/data/{filter}/{id}/{start}/{end}', 'KesehatanController@laporan_harian_data');
Route::get('/laporan_mingguan/data/{filter_mingguan}/{filter}/{id}/{start}/{end}', 'KesehatanController@laporan_mingguan_data');
Route::get('/laporan_bulanan/data/{filter_bulanan}/{filter}/{id}/{start}/{end}', 'KesehatanController@laporan_bulanan_data');
Route::get('/laporan_tahunan/data/{filter}/{id}/{start}/{end}', 'KesehatanController@laporan_tahunan_data');

//Karyawan
Route::group(['prefix' => '/karyawan', 'middleware' => 'auth'], function () {
    Route::get('/', 'CommonController@karyawan');   /* Tabel */
    Route::get('/tambah', 'CommonController@karyawan_tambah');
    //KARYAWAN PEMINJAMAN
    Route::get('/peminjaman', 'ItController@karyawan_peminjaman')->name('karyawan.peminjaman');
    Route::get('/peminjaman/show', 'ItController@karyawan_peminjaman_show')->name('karyawan.peminjaman.show');
});

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
    Route::get('/create/get_bom/{id}', 'GetController@get_bom')->name('bppb.get_bom');
    Route::get('/create/get_model_bom/{id}', 'GetController@get_model_bom')->name('bppb.get_model_bom');

    Route::group(['prefix' => '/permintaan_bahan_baku'], function () {
        Route::get('/{id}', 'PpicController@bppb_permintaan_bahan_baku')->name('bppb.permintaan_bahan_baku');
        Route::get('/show/{id}', 'PpicController@bppb_permintaan_bahan_baku_show')->name('bppb.permintaan_bahan_baku.show');
        Route::get('/status/{id}/{status}', 'PpicController@bppb_permintaan_bahan_baku_status')->name('bppb.permintaan_bahan_baku.status');
        Route::get('/create/{id}', 'ProduksiController@bppb_permintaan_bahan_baku_create')->name('bppb.permintaan_bahan_baku.create');
        Route::put('/store/{id}', 'ProduksiController@bppb_permintaan_bahan_baku_store')->name('bppb.permintaan_bahan_baku.store');
        Route::get('/edit/{id}', 'PpicController@bppb_permintaan_bahan_baku_edit')->name('bppb.permintaan_bahan_baku.edit');
        Route::put('/update/{id}', 'PpicController@bppb_permintaan_bahan_baku_update')->name('bppb.permintaan_bahan_baku.update');
        Route::delete('/delete/{id}', 'PpicController@bppb_permintaan_bahan_baku_delete')->name('bppb.permintaan_bahan_baku.delete');
        Route::get('/detail/{id}', 'PpicController@bppb_permintaan_bahan_baku_detail')->name('bppb.permintaan_bahan_baku.detail');
        Route::get('/detail/show/{id}', 'PpicController@bppb_permintaan_bahan_baku_detail_show')->name('bppb.permintaan_bahan_baku.detail.show');
    });

    Route::group(['prefix' => '/pengembalian_barang_gudang'], function () {
        Route::get('/{id}', 'PpicController@bppb_pengembalian_barang_gudang')->name('bppb.pengembalian_barang_gudang');
        Route::get('/show/{id}', 'PpicController@bppb_pengembalian_barang_gudang_show')->name('bppb.pengembalian_barang_gudang.show');
        Route::get('/status/{id}/{status}', 'PpicController@bppb_pengembalian_barang_gudang_status')->name('bppb.pengembalian_barang_gudang.status');
        Route::get('/create/{id}', 'ProduksiController@bppb_pengembalian_barang_gudang_create')->name('bppb.pengembalian_barang_gudang.create');
        Route::put('/store/{id}', 'ProduksiController@bppb_pengembalian_barang_gudang_store')->name('bppb.pengembalian_barang_gudang.store');
        Route::get('/edit/{id}', 'ProduksiController@bppb_pengembalian_barang_gudang_edit')->name('bppb.pengembalian_barang_gudang.edit');
        Route::put('/update/{id}', 'ProduksiController@bppb_pengembalian_barang_gudang_update')->name('bppb.pengembalian_barang_gudang.update');
        Route::delete('/delete/{id}', 'PpicController@bppb_pengembalian_barang_gudang_delete')->name('bppb.pengembalian_barang_gudang.delete');
        Route::get('/detail/{id}', 'PpicController@bppb_pengembalian_barang_gudang_detail')->name('bppb.pengembalian_barang_gudang.detail');
        Route::get('/detail/show/{id}', 'PpicController@bppb_pengembalian_barang_gudang_detail_show')->name('bppb.pengembalian_barang_gudang.detail.show');
    });

    Route::group(['prefix' => '/penyerahan_barang_jadi'], function () {
        Route::get('/{id}', 'PpicController@bppb_penyerahan_barang_jadi')->name('bppb.penyerahan_barang_jadi');
        Route::get('/show/{id}', 'PpicController@bppb_penyerahan_barang_jadi_show')->name('bppb.penyerahan_barang_jadi.show');
        Route::get('/status/{id}/{status}', 'PpicController@bppb_penyerahan_barang_jadi_status')->name('bppb.penyerahan_barang_jadi.status');
        Route::get('/create/{id}', 'ProduksiController@bppb_penyerahan_barang_jadi_create')->name('bppb.penyerahan_barang_jadi.create');
        Route::put('/store/{id}', 'ProduksiController@bppb_penyerahan_barang_jadi_store')->name('bppb.penyerahan_barang_jadi.store');
    });

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


//PERSIAPAN
Route::group(['prefix' => '/persiapan_packing_produk', 'middleware' => 'auth'], function () {
    Route::get('/', 'ProduksiController@persiapan_packing_produk')->name('persiapan_packing_produk');
    Route::get('/show', 'ProduksiController@persiapan_packing_produk_show')->name('persiapan_packing_produk.show');
    Route::get('/create/{id}', 'ProduksiController@persiapan_packing_produk_create')->name('persiapan_packing_produk.create');
    Route::put('/store/{id}', 'ProduksiController@persiapan_packing_produk_store')->name('persiapan_packing_produk.store');
    Route::get('/edit/{id}', 'ProduksiController@persiapan_packing_produk_edit')->name('persiapan_packing_produk.edit');
    Route::put('/update/{id}', 'ProduksiController@persiapan_packing_produk_update')->name('persiapan_packing_produk.update');
    Route::get('/detail/{id}', 'ProduksiController@persiapan_packing_produk_detail')->name('persiapan_packing_produk.detail');
    Route::get('/detail/show/{id}', 'ProduksiController@persiapan_packing_produk_detail_show')->name('persiapan_packing_produk.detail.show');
});


//PERAKITAN
Route::group(['prefix' => '/perakitan', 'middleware' => 'auth'], function () {
    Route::get('/eng', 'EngController@perakitan')->name('perakitan.eng');
    Route::get('/show/eng', 'EngController@perakitan_show')->name('perakitan.show.eng');
    Route::get('/mtc', 'MtcController@perakitan')->name('perakitan.mtc');
    Route::get('/show/mtc', 'MtcController@perakitan_show')->name('perakitan.show.mtc');

    Route::get('/mtc', 'MtcController@perakitan')->name('perakitan.mtc');
    Route::get('/show/mtc', 'MtcController@perakitan_show')->name('perakitan.show.mtc');

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
        Route::get('/create/get_alias_operator/{acc}', 'GetController@get_alias_operator');
        Route::get('/create/get_karyawan_divisi/{arr}', 'GetController@get_karyawan_divisi');
        Route::get('/create/get_alias_exist/{id}/{alias}', 'GetController@get_alias_exist');
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
        Route::get('/create/get_count_hasil_perakitan/{id}', 'GetController@get_count_hasil_perakitan');    /* Create */
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
    Route::get('/analisa_ps/show/{id}', 'EngController@perakitan_analisa_ps_show')->name('perakitan.analisa_ps.show');
    Route::get('/analisa_ps/create/{id}', 'EngController@perakitan_analisa_ps_create')->name('perakitan.analisa_ps.create');
    Route::put('/analisa_ps/store/{id}', 'EngController@perakitan_analisa_ps_store')->name('perakitan.analisa_ps.store');
});


//PENGUJIAN
Route::group(['prefix' => '/pengujian', 'middleware' => 'auth'], function () {
    Route::get('/', 'QCController@pengujian')->name('pengujian');
    Route::get('/eng', 'EngController@pengujian')->name('pengujian.eng');
    Route::get('/bppb/{id}', 'QCController@pengujian_bppb')->name('pengujian.bppb');
    Route::get('/bppb/show/{id}', 'QCController@pengujian_bppb_show')->name('pengujian.bppb.show');
    Route::get('/show/mtc', 'MtcController@pengujian_show')->name('pengujian.show.mtc');
    Route::get('/mtc', 'MtcController@pengujian')->name('pengujian.mtc');
    Route::get('/show/eng', 'EngController@pengujian_show')->name('pengujian.show.eng');
    Route::get('/show', 'QCController@pengujian_show')->name('pengujian.show');
    Route::get('/perbaikan', 'ProduksiController@pengujian_perbaikan')->name('pengujian.perbaikan');
    Route::get('/perbaikan/show', 'ProduksiController@pengujian_perbaikan_show')->name('pengujian.perbaikan.show');
    Route::get('/perbaikan/bppb/{id}', 'ProduksiController@pengujian_perbaikan_bppb')->name('pengujian.perbaikan.bppb');
    Route::get('/perbaikan/bppb/show/{id}', 'ProduksiController@pengujian_perbaikan_bppb_show')->name('pengujian.perbaikan.bppb.show');
    Route::get('/perbaikan/status/{id}/{status}', 'ProduksiController@pengujian_perbaikan_status')->name('pengujian.perbaikan.status');

    Route::group(['prefix' => '/monitoring_proses'], function () {
        Route::get('/', 'QCController@pengujian_monitoring_proses')->name('pengujian.monitoring_proses');
        Route::get('/show/{bppb_id}', 'QCController@pengujian_monitoring_proses_show')->name('pengujian.monitoring_proses.show');
        Route::get('/create/{bppb_id}', 'QCController@pengujian_monitoring_proses_create')->name('pengujian.monitoring_proses.create');
        Route::put('/store/{bppb_id}', 'QCController@pengujian_monitoring_proses_store')->name('pengujian.monitoring_proses.store');

        Route::group(['prefix' => '/hasil'], function () {
            Route::get('/{id}', 'QCController@pengujian_monitoring_proses_hasil')->name('pengujian.monitoring_proses.hasil');
            Route::get('/show/{id}', 'QCController@pengujian_monitoring_proses_hasil_show')->name('pengujian.monitoring_proses.hasil.show');
            Route::get('/status/{id}/{status}', 'QCController@pengujian_monitoring_proses_hasil_status')->name('pengujian.monitoring_proses.hasil.status');
            Route::get('/create/{id}', 'QCController@pengujian_monitoring_proses_hasil_create')->name('pengujian.monitoring_proses.hasil.create');
            Route::put('/store/{id}', 'QCController@pengujian_monitoring_proses_hasil_store')->name('pengujian.monitoring_proses.hasil.store');
            Route::get('/edit/{id}', 'QCController@pengujian_monitoring_proses_hasil_edit')->name('pengujian.monitoring_proses.hasil.edit');
            Route::put('/update/{id}', 'QCController@pengujian_monitoring_proses_hasil_update')->name('pengujian.monitoring_proses.hasil.update');
            Route::delete('/delete/{id}', 'QCController@pengujian_monitoring_proses_hasil_delete')->name('pengujian.monitoring_proses.hasil.delete');
        });

        Route::group(['prefix' => '/laporan'], function () {
            Route::get('/create/{id}', 'QCController@pengujian_monitoring_proses_laporan_create')->name('pengujian.monitoring_proses.laporan.create');
            Route::put('/store/{id}', 'QCController@pengujian_monitoring_proses_laporan_store')->name('pengujian.monitoring_proses.laporan.store');
            Route::get('/edit/{id}', 'QCController@pengujian_monitoring_proses_laporan_edit')->name('pengujian.monitoring_proses.laporan.edit');
            Route::put('/update/{id}', 'QCController@pengujian_monitoring_proses_laporan_update')->name('pengujian.monitoring_proses.laporan.update');
        });
    });

    Route::group(['prefix' => '/ik_pemeriksaan'], function () {
        Route::get('/', 'QCController@pengujian_ik_pemeriksaan')->name('pengujian.ik_pemeriksaan');
        Route::get('/show', 'QCController@pengujian_ik_pemeriksaan_show')->name('pengujian.ik_pemeriksaan.show');
        Route::get('/create', 'QCController@pengujian_ik_pemeriksaan_create')->name('pengujian.ik_pemeriksaan.create');
        Route::get('/get_detail_produk_by_id/{id}', 'GetController@get_detail_produk_by_id');
        Route::post('/store', 'QCController@pengujian_ik_pemeriksaan_store')->name('pengujian.ik_pemeriksaan.store');
        Route::get('/detail/{id}', 'QCController@pengujian_ik_pemeriksaan_detail')->name('pengujian.ik_pemeriksaan.detail');
        Route::get('/hasil/edit/{id}', 'QCController@pengujian_ik_pemeriksaan_hasil_edit')->name('pengujian.ik_pemeriksaan.hasil.edit');
        Route::put('/hasil/update/{id}', 'QCController@pengujian_ik_pemeriksaan_hasil_update')->name('pengujian.ik_pemeriksaan.hasil.update');
    });

    Route::group(['prefix' => '/pemeriksaan_proses'], function () {
        Route::get('/', 'QCController@pengujian_pemeriksaan_proses')->name('pengujian.pemeriksaan_proses');
        Route::get('/show/{id}', 'QCController@pengujian_pemeriksaan_proses_show')->name('pengujian.pemeriksaan_proses.show');
        Route::get('/hasil/{id}', 'QCController@pengujian_pemeriksaan_proses_hasil')->name('pengujian.pemeriksaan_proses.hasil');
        Route::get('/create/{id}', 'QCController@pengujian_pemeriksaan_proses_create')->name('pengujian.pemeriksaan_proses.create');
        Route::put('/store/{id}', 'QCController@pengujian_pemeriksaan_proses_store')->name('pengujian.pemeriksaan_proses.store');
        Route::get('/not_ok', 'QCController@pengujian_pemeriksaan_proses_not_ok')->name('pengujian.pemeriksaan_proses.not_ok');
        Route::get('/not_ok/show/{bppb_id}/{ik_pengujian_id}', 'QCController@pengujian_pemeriksaan_proses_not_ok_show')->name('pengujian.pemeriksaan_proses.not_ok.show');
    });

    Route::get('/analisa_ps/show/{id}', 'EngController@pengujian_analisa_ps_show')->name('pengujian.analisa_ps.show');
    Route::get('/analisa_ps/create/{id}', 'EngController@pengujian_analisa_ps_create')->name('pengujian.analisa_ps.create');
    Route::put('/analisa_ps/store/{id}', 'EngController@pengujian_analisa_ps_store')->name('pengujian.analisa_ps.store');
});


// PENGEMASAN
Route::group(['prefix' => '/pengemasan', 'middleware' => 'auth'], function () {
    Route::get('/', 'ProduksiController@pengemasan')->name('pengemasan');
    Route::get('/eng', 'EngController@pengemasan')->name('pengemasan.eng');
    Route::get('/show/eng', 'EngController@pengemasan_show')->name('pengemasan.show.eng');
    Route::get('/qc', 'QCController@pengemasan')->name('pengemasan.qc');
    Route::get('/show/qc', 'QCController@pengemasan_show')->name('pengemasan.show.qc');
    Route::get('/bppb/show/qc/{bppbid}', 'QCController@pengemasan_bppb_show')->name('pengemasan.bppb.show.qc');
    Route::get('/bppb/edit/qc/{bppbid}', 'QCController@pengemasan_bppb_edit')->name('pengemasan.bppb.edit.qc');
    Route::put('/bppb/update/qc/{bppbid}', 'QCController@pengemasan_bppb_update')->name('pengemasan.bppb.update.qc');
    Route::get('/hasil/edit/qc/{id}', 'QCController@pengemasan_hasil_edit')->name('pengemasan.hasil.edit.qc');
    Route::put('/hasil/update/qc/{id}', 'QCController@pengemasan_hasil_update')->name('pengemasan.hasil.update.qc');
    Route::get('/form', 'ProduksiController@pengemasan_form')->name('pengemasan.form');
    Route::get('/form/show', 'ProduksiController@pengemasan_form_show')->name('pengemasan.form.show');
    Route::get('/form/create', 'ProduksiController@pengemasan_form_create')->name('pengemasan.form.create');
    Route::post('/form/store', 'ProduksiController@pengemasan_form_store')->name('pengemasan.form.store');
    Route::get('/form/create/get_detail_produk_by_id/{id}', 'GetController@get_detail_produk_by_id');
    Route::get('/show', 'ProduksiController@pengemasan_show')->name('pengemasan.show');
    Route::get('/laporan', 'ProduksiController@pengemasan_laporan')->name('pengemasan.laporan');
    Route::get('/laporan/show/{id}', 'ProduksiController@pengemasan_laporan_show')->name('pengemasan.laporan.show');
    Route::get('/laporan/status/{id}/{status}', 'ProduksiController@pengemasan_laporan_status')->name('pengemasan.laporan.status');
    Route::get('/laporan/create/{bppb_id}', 'ProduksiController@pengemasan_laporan_create')->name('pengemasan.laporan.create');
    Route::put('/laporan/store/{bppb_id}', 'ProduksiController@pengemasan_laporan_store')->name('pengemasan.laporan.store');
    Route::get('/hasil/{id}', 'ProduksiController@pengemasan_hasil')->name('pengemasan.hasil');
    Route::get('/hasil/show/{id}', 'ProduksiController@pengemasan_hasil_show')->name('pengemasan.hasil.show');
    Route::get('/hasil/create/{id}', 'ProduksiController@pengemasan_hasil_create')->name('pengemasan.hasil.create');
    Route::put('/hasil/store/{id}', 'ProduksiController@pengemasan_hasil_store')->name('pengemasan.hasil.store');
});


// PERBAIKAN
Route::group(['prefix' => '/perbaikan', 'middleware' => 'auth'], function () {
    Route::get('/produksi', 'ProduksiController@perbaikan_produksi')->name('perbaikan.produksi');
    Route::get('/produksi/show', 'ProduksiController@perbaikan_produksi_show')->name('perbaikan.produksi.show');
    Route::get('/produksi/create/{id}/{proses}', 'ProduksiController@perbaikan_produksi_create')->name('perbaikan.produksi.create');
    Route::put('/produksi/store/{id}', 'ProduksiController@perbaikan_produksi_store')->name('perbaikan.produksi.store');
    Route::get('/produksi/edit/{id}', 'ProduksiController@perbaikan_produksi_edit')->name('perbaikan.produksi.edit');
    Route::put('/produksi/update/{id}', 'ProduksiController@perbaikan_produksi_update')->name('perbaikan.produksi.update');
    Route::get('/produksi/detail/{id}', 'ProduksiController@perbaikan_produksi_detail')->name('perbaikan.produksi.detail');
});


// DOCUMENT CONTROL
Route::group(['prefix' => 'dc', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'digidocu\DocumentsController@dashboard')->name('dc.dashboard');
    Route::get('/dep_doc/{id?}', 'digidocu\DocumentsController@dep_doc')->name('dc.dep_doc');
    // documents
    Route::resource('documents', 'digidocu\DocumentsController');
    Route::get('documents/download/{id}', 'DocumentsController@download');
    Route::get('documents/open/{id}', 'digidocu\DocumentsController@open');
    Route::get('mydocuments', 'digidocu\DocumentsController@mydocuments');
    Route::get('/trash', 'DocumentsController@trash');
    Route::get('documents/restore/{id}', 'DocumentsController@restore');
    Route::delete('documentsDeleteMulti', 'DocumentsController@deleteMulti');
});

// ARI Controller Temporary

Route::get('/doc/test', function (Request $request) {
    $query = parse_url($request->fullUrl())['query'];
    $result = [];
    parse_str($query, $result);
    dd($result);
});

//GUDANG
Route::get('gudang_view', function () {
    return view('page.gudang.gudang');
});
Route::get('/gudang', 'GudangController@index')->name('gudang');
Route::get('/gudang/data', 'GudangController@get_data')->name('gudang.data');


//PPIC
Route::group(['prefix' => 'ppic', 'middleware' => 'auth'], function () {
    Route::get('/schedule', 'PpicController@schedule_show');
    Route::post('/schedule/create', 'PpicController@schedule_create');
    Route::post('/schedule/delete', 'PpicController@schedule_delete');
    Route::get('/bom', 'PpicController@bom');
    Route::get('/get_bom/{id}', 'PpicController@get_bom');
    Route::get('/get_part', 'PpicController@get_part');
});


// Eng
Route::view('/eng', 'page.engineering.index');
Route::get('/eng/index', 'EngController@test');
Route::get('/show_list/{produk?}/{document?}', 'EngController@show_list');
Route::post('/eng/fileupload', 'EngController@fileupload')->name('eng.fileupload');
Route::get('test_spa', 'EngController@index');


Route::get('/chat', 'ChatController@index');
Route::get('/message', 'ChatController@fetchMessages');
Route::post('/message', 'ChatController@sendMessage');

Route::post('/notif', 'PpicController@schedule_notif')->middleware('auth');
Route::get('/stok', function () {
    event(new cek_stok('pesan'));
    return "notif send";
});

Route::get('/welcome', function () {
    return view('welcome');
});
