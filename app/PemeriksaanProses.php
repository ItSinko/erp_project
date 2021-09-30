<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanProses extends Model
{
    protected $table = 'pemeriksaan_proses';
    protected $fillable = ['bppb_id', 'tanggal', 'proses', 'status', 'nomor'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function HasilPemeriksaanProses()
    {
        return $this->hasMany(HasilPemeriksaanProses::class);
    }
}
