<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = ['detail_produk_id', 'produk_bill_of_material_id', 'jumlah_produksi', 'tanggal_mulai', 'tanggal_selesai', 'status', 'warna', 'konfirmasi'];

    public function ProdukBillOfMaterial()
    {
        return $this->hasOne(ProdukBillOfMaterial::class, 'id', 'produk_bill_of_material_id');
    }

    public function DetailProduk()
    {
        return $this->hasOne(DetailProduk::class, 'id', 'detail_produk_id');
    }
}
