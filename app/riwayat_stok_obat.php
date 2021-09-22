<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riwayat_stok_obat extends Model
{
    protected $table = 'riwayat_stok_obats';
    protected $primaryKey = 'id';
    protected $fillable = ['obat_id', 'tgl_pembelian', 'stok', 'keterangan'];

    public function Obat()
    {
        return $this->belongsTo('App\Obat', 'obat_id');
    }
}
