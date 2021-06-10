<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaanBahanBaku extends Model
{
    protected $fillable = ['permintaan_bahan_baku_id', 'bill_of_material_id', 'jumlah_diminta', 'jumlah_diterima'];

    public function PermintaanBahanBaku()
    {
        return $this->belongsTo(PermintaanBahanBaku::class);
    }

    public function BillOfMaterial()
    {
        return $this->belongsTo(BillOfMaterial::class);
    }
}
