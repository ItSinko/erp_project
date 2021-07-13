<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartOrder extends Model
{
    protected $table = "part_order";
    protected $fillable = ['kode', 'jumlah'];
    public $timestamps = false;
}
