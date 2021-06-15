<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPengembalianBarangGudang extends Model
{
    protected $fillable = ['pengembalian_barang_gudang_id', 'bill_of_material_id', 'jumlah_ok', 'jumlah_nok'];

    public function PengembalianBarangGudang()
    {
        return $this->belongsTo(PengembalianBarangGudang::class);
    }

    public function BillOfMaterial()
    {
        return $this->belongsTo(BillOfMaterial::class);
    }
}
