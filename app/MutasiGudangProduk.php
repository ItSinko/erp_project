<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MutasiGudangProduk extends Model
{
    protected $fillable = ['gudang_produk_id', 'divisi_id', 'tanggal', 'keterangan', 'jumlah_masuk', 'jumlah_keluar', 'jumlah_saldo'];

    public function GudangProduk()
    {
        return $this->belongsTo(GudangProduk::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
