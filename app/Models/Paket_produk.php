<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket_produk extends Model
{
   
    protected $primaryKey = 'id';
    protected $fillable = ['tipe','harga'];

    public function spaon(){
        return $this->hasMany('App\Spaon');
    }
    public function podo_on(){
        return $this->hasMany('App\podo_on');
    }
    public function sjon(){
        return $this->hasMany('App\Sjon');
    }
    public function detail_paket_produk(){
        return $this->hasMany('App\Detail_paket_produk');
    }
}
