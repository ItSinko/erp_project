<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\HasilPerakitan;
use App\Divisi;

class Bppb extends Model
{
    protected $fillable = ['produk_id', 'no_bppb', 'tanggal_bppb', 'divisi_id', 'jumlah'];
    
    public function Produk()
    {
        return $this->belongsTo(Produk::class);
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

        foreach($k as $l)
        {
            $m = Perakitan::find($l->id);
            $count = $count + $m->HasilPerakitan->count();
        }

        return $count;
    }
}