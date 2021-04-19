<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\HasilPerakitanKaryawan;
use App\Karyawan;
use App\HistoriHasilPerakitan;

class HasilPerakitan extends Model
{
    protected $fillable = ['perakitan_id', 'tanggal', 'no_seri', 'warna', 'kondisi', 'keterangan'];

    public function Perakitan()
    {
        return $this->belongsTo(Perakitan::class);
    }

    public function HasilPerakitanKaryawan()
    {
        return $this->hasMany(HasilPerakitanKaryawan::class);
    }

    public function Karyawan()
    {
        return $this->belongsToMany(Karyawan::class, 'hasil_perakitan_karyawans')->withPivot('operator_custom')->withTimestamps();
    }

    public function HistoriHasilPerakitan()
    {
        return $this->hasMany(HistoriHasilPerakitan::class);
    }

    public function countStatus($status)
    {
        $k = $this->id;
        $h = HistoriHasilPerakitan::where([
            ['hasil_perakitan_id', '=', $k],
            ['status', '=', $status]
        ])->count();

        return $h;
    }
}
