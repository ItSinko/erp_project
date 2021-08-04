<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListKalibrasi extends Model
{
    protected $fillable = ['kalibrasi_id', 'hasil_perakitan_id', 'no_barcode', 'tanggal_kalibrasi', 'tanggal_selesai', 'hasil', 'tindak_lanjut', 'status'];

    public function Kalibrasi()
    {
        return $this->belongsTo(Kalibrasi::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}
