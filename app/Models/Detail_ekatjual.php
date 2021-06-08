<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_ekatjual extends Model
{
    protected $table = 'detail_ekatjuals';
    protected $primaryKey = 'id';
    protected $fillable = ['ekatjuals_id', 'produk_id', 'harga', 'jumlah'];



    // public function ekatjual()
    // {
    //     return $this->belongsto('App\Ekatjual', 'ekatjuals_id');
    // }


    public function produk()
    {
        return $this->belongsto('App\Produk', 'produk_id');
    }
}
