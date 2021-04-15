<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BillOfMaterial;
use App\KelompokProduk;
use App\KategoriProduk;

class Produk extends Model
{
    protected $fillable = ['kelompok_produk_id', 'kategori_id', 'merk', 'tipe', 'nama', 'kode', 'kode_barcode', 'foto', 'berat', 'satuan', 'nama_coo', 'no_akd', 'harga', 'keterangan'];

    public function Bppb()
    {
        return $this->hasOne(Bppb::class);
    }
    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class);
    }
    public function KelompokProduk()
    {
        return $this->belongsTo(KelompokProduk::class, 'kelompok_produk_id');
    }
    public function KategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
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
