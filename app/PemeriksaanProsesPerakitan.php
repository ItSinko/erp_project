<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanProsesPerakitan extends Model
{
    protected $table = 'pemeriksaan_proses_perakitan';
    protected $fillable = ['bppb_id']
}
