<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Karyawan;
use App\HasilPerakitan;

class HasilPerakitanKaryawan extends Model
{
    protected $fillable = ['hasil_perakitan_id', 'karyawan_id', 'operator_custom'];

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}
