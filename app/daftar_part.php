<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daftar_part extends Model
{
    protected $table = 'parts';
    protected $primaryKey = 'id';
    protected $fillable = ['kode', 'nama', 'jumlah', 'satuan', 'layout', 'status'];
}
