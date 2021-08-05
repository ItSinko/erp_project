<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LkpLupPengujian extends Model
{
    protected $fillable = ['karyawan_id', 'hasil_perakitan_id', 'no_barcode', 'tanggal_pengujian', 'tanggal_expired', 'keterangan', 'status'];

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
