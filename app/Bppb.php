<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\Pengemasan;
use App\DetailProduk;
use App\Divisi;

class Bppb extends Model
{
    protected $fillable = ['detail_produk_id', 'no_bppb', 'tanggal_bppb', 'divisi_id', 'jumlah'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function Perakitan()
    {
        return $this->hasMany(Perakitan::class);
    }

    public function countHasilPerakitan()
    {
        $count = 0;
        $k = $this->Perakitan;

        foreach ($k as $l) {
            $m = Perakitan::find($l->id);
            $count = $count + $m->HasilPerakitan->count();
        }

        return $count;
    }

    public function Pengemasan()
    {
        return $this->hasMany(Pengemasan::class);
    }

    public function countHasilPengemasan()
    {
        $count = 0;
        $k = $this->Pengemasan;

        foreach ($k as $l) {
            $m = Pengemasan::find($l->id);
            $count = $count + $m->HasilPengemasan->count();
        }

        return $count;
    }
}
