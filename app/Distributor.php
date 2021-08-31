<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributors';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis', 'nama', 'alamat', 'email', 'telp', 'dis_nota', 'dis_uji', 'tempo', 'ket'];

    public function ekatjual()
    {
        return $this->hasMany('App\Ekatjual');
    }

    public function ecommerce()
    {
        return $this->hasMany('App\Ecommerces');
    }
    //public function podo_on(){
    //  return $this->hasMany('App\podo_on');
    //}
    // public function sjon(){
    //     return $this->hasMany('App\Sjon');
    // }


}
