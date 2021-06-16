<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisaPsPerakitan extends Model
{
    protected $fillable = ['ppic_id', 'hasil_perakitan_id', 'analisa', 'realisasi_pengerjaan', 'tindak_lanjut'];
    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }

    public function BillOfMaterial()
    {
        return $this->belongsToMany(BillOfMaterial::class, 'analisa_ps_perakitan_parts');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'ppic_id');
    }
}
