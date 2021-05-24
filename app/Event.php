<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = ['title', 'start', 'end', 'status', 'jumlah', 'color'];
}
