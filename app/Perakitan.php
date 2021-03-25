<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bppb;
use App\User;
use App\HasilPerakitan;
class Perakitan extends Model
{
    protected $fillable = ['bppb_id','pic_id','tanggal','status'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function HasilPerakitan()
    {
        return $this->hasMany(HasilPerakitan::class);
    }
}