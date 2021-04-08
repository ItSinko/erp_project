<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Karyawan;
use App\PeminjamanKaryawan;

class DetailPeminjamanKaryawan extends Model
{
    protected $fillable = ['peminjaman_karyawan_id', 'karyawan_id', 'tanggal_pemberhentian', 'status', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function PeminjamanKaryawan()
    {
        return $this->belongsTo(PeminjamanKaryawan::class);
    }
}
