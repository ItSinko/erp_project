<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitoringProses extends Model
{
    protected $fillable = ['bppb_id', 'tanggal', 'karyawan_id', 'user_id', 'alias_barcode'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function HasilMonitoringProses()
    {
        return $this->hasMany(HasilMonitoringProses::class);
    }
}
