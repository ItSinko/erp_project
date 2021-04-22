<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KelompokProduk;
use App\KategoriProduk;
use App\DetailProduk;

class Produk extends Model
{
    protected $fillable = ['kelompok_produk_id', 'kategori_id', 'merk', 'tipe', 'nama', 'kode_barcode', 'nama_coo', 'no_akd', 'keterangan'];

    public function KelompokProduk()
    {
        return $this->belongsTo(KelompokProduk::class);
    }
    public function KategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function DetailProduk()
    {
        return $this->hasMany(DetailProduk::class);
    }

    public function detail_paket_produk()
    {
        return $this->hasMany('App\Detail_paket_produk');
    }
    public function detail_ekatjual()
    {
        return $this->hasMany('App\Produk');
    }
    public function detail_ecommerces()
    {
        return $this->hasMany('App\Detail_ecommereces');
    }
}
