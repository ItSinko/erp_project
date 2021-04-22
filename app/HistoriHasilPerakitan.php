<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriHasilPerakitan extends Model
{
    protected $fillable = ['hasil_perakitan_id', 'kegiatan', 'tanggal', 'hasil', 'keterangan', 'tindak_lanjut'];

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}
