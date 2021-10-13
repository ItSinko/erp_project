<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_obat extends Model
{
    protected $table = 'detail_obats';
    protected $fillable = ['karyawan_sakit_id', 'obat_id', 'jumlah', 'aturan', 'konsumsi'];

    public function obat()
    {
        return $this->belongsTo('App\obat', 'obat_id');
    }

    public function karyawan_sakit()
    {
        return $this->belongsTo('App\karyawan_sakit', 'karyawan_sakit_id');
    }
}
