<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sjon extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['nosj','tglsj','ket','spaon_id'];

    public function podo_on(){
        return $this->belongsTo('App\Podo_on');
    }
    public function spaon(){
        return $this->belongsTo('App\Spaon');
    }
    public function paket_produk(){
        return $this->belongsTo('App\Paket_produk');
    }
    public function distributor(){
        return $this->belongsTo('App\Dsb');
    }
}
