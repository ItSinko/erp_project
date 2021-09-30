<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailIkPemeriksaan extends Model
{
    protected $fillable = ['list_ik_pemeriksaan_id', 'penerimaan'];

    public function ListIkPemeriksaan()
    {
        return $this->belongsTo(ListIkPemeriksaan::class);
    }

    public function HasilPemeriksaanProses()
    {
        return $this->belongsTo(HasilPemeriksaanProses::class);
    }
}
