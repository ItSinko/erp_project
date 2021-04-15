<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['nama', 'kode_eng', 'kode_gudang', 'jumlah', 'foto'];

    public function PartEng()
    {
        return $this->hasMany(PartEng::class);
    }
}
