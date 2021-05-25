<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPengemasan extends Model
{
    protected $fillable = ['pengemasan_id', 'hasil_perakitan_id', 'no_barcode', 'kondisi_unit', 'hasil', 'keterangan', 'tindak_lanjut', 'status'];

    public function Pengemasan()
    {
        return $this->belongsTo(Pengemasan::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }

    public function DetailCekPengemasan()
    {
        return $this->belongsToMany(DetailCekPengemasan::class, 'hasil_pengemasan_detail_cek_pengemasans', 'hasil_id', 'detail_cek_id')->withTimestamps();
    }

    public function PerbaikanProduksi()
    {
        return $this->belongsToMany(PerbaikanProduksi::class, 'perbaikan_produksi_pengemasans')->withTimestamps();
    }

    public function latestPerbaikan()
    {
        $id = $this->Pengemasan->id;
        $p = PerbaikanProduksi::whereHas('HasilPengemasan', function ($q) use ($id) {
            $q->where('id', $id);
        })->orderby('updated_at', 'desc')->first();
        return $p->id;
    }
}
