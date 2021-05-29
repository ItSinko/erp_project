<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenyerahanBarangJadi extends Model
{
    protected $fillable = ['penyerahan_barang_jadil_id', 'hasil_pengemasan_id'];

    public function PenyerahanBarangJadi()
    {
        return $this->belongsTo(PenyerahanBarangJadi::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}
