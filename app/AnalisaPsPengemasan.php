<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisaPsPengemasan extends Model
{
    protected $fillable = ['hasil_pengemasan_id', 'analisa', 'realisasi_pengerjaan', 'tindak_lanjut'];

    public function HasilPengemasan()
    {
        return $this->belongsTo(HasilPengemasan::class);
    }

    public function BillOfMaterial()
    {
        return $this->belongsToMany(BillOfMaterial::class, 'analisa_ps_pengujian_parts');
    }
}
