<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListKalibrasiInternal extends Model
{
    protected $fillable = ['kalibrasi_internal_id', 'hasil_perakitan_id', 'no_barcode', 'tanggal_kalibrasi', 'tanggal_selesai', 'hasil', 'tindak_lanjut', 'status'];

    public function KalibrasiInternal()
    {
        return $this->belongsTo(KalibrasiInternal::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}
