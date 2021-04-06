<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan_produk extends Model
{
    protected $table = 'produks';
    protected $primaryKey = 'id';
    protected $fillable = ['merk', 'tipe', 'nama', 'harga', 'satuan', 'no_akd', 'keterangan'];
}
