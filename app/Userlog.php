<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserLog extends Model
{
    protected $fillable = ['user_id', 'aksi_id', 'tabel_aksi', 'aksi', 'keterangan'];
    public function User()
    {
        $this->belongsTo(User::class);
    }
}
