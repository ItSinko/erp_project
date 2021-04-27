<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penawaran_ecom extends Model
{
    protected $table = 'penawaran_ecoms';
    protected $primaryKey = 'id';
    protected $fillable = ['ecommerce_id', 'tujuan', 'deskripsi', 'tgl_surat', 'karyawan_id'];

    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
    public function ecommerce()
    {
        return $this->belongsTo('App\Ecommerces', 'ecommerce_id');
    }
}
