<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKartuStockGbj extends Model
{
    protected $fillable = ['kartu_stock_id', 'tanggal', '', 'keterangan', 'jumlah_masuk', 'jumlah_keluar', 'saldo'];

    public function KartuStockGbj()
    {
        return $this->belongsTo(KartuStockGbj::class, 'kartu_stock_id');
    }
}
