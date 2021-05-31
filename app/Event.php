<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = ['nama_produk', 'tanggal_mulai', 'tanggal_selesai', 'status', 'jumlah_produksi', 'warna'];
}
