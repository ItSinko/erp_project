<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = ['detail_produk_id', 'jumlah_produksi', 'tanggal_mulai', 'tanggal_selesai', 'status', 'warna', 'versi_bom'];

    public function detail_produk()
    {
        return $this->belongsTo('App\DetailProduk');
    }
}
