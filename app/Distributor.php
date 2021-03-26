<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributors';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis', 'pabrik', 'alamat', 'email', 'telp', 'dis_nota', 'dis_uji', 'tempo'];

    //public function spaon(){
    // return $this->hasMany('App\Spaon');
    // }
    //public function podo_on(){
    //  return $this->hasMany('App\podo_on');
    //}
    // public function sjon(){
    //     return $this->hasMany('App\Sjon');
    // }


}
