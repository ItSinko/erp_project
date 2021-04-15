<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_offline extends Model
{
    protected $table = 'detail_offlines';
    protected $primaryKey = 'id';
    protected $fillable = ['offline_id', 'produk_id', 'harga', 'jumlah', 'keterangan'];

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id');
    }
}
