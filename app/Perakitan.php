<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bppb;
use App\User;
use App\HasilPerakitan;
use App\Karyawan;

class Perakitan extends Model
{
    protected $fillable = ['bppb_id', 'pic_id', 'tanggal', 'status'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Karyawan()
    {
        return $this->belongsToMany(Karyawan::class, 'perakitan_karyawans')->withPivot('operator_custom')->withTimestamps();
    }

    public function HasilPerakitan()
    {
        return $this->hasMany(HasilPerakitan::class);
    }
}
