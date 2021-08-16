<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatLkpLup extends Model
{
    protected $fillable = ["produk_id", "nama_pengecekan"];

    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function AcuanLkpLup()
    {
        return $this->hasMany(AcuanLkpLup::class);
    }
}
