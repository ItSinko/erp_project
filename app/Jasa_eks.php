<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa_eks extends Model
{
    protected $table = 'jasa_ekss';
    protected $primaryKey = 'id';
    protected $fillable = ['ekspedisi', 'telp', 'alamat', 'via', 'jur', 'ket'];
}
