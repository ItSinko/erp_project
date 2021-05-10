<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanProsesPengujian extends Model
{
    protected $fillable = ['bppb_id', 'no_pemeriksaan', 'tanggal', 'jumlah_produksi', 'jumlah_sampling'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function HasilPemeriksaanProsesPengujian()
    {
        return $this->hasMany(HasilPemeriksaanProsesPengujian::class, 'pemeriksaan_id');
    }
}
