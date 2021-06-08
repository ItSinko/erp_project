<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Notifikasi extends Model
{
    protected $fillable = ['judul','pesan','pengirim_id','penerima_id','halaman_url','read_at'];
    
    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
