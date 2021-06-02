<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = "parts";
    protected $fillable = ['nama', 'kode', 'jumlah', 'foto'];

    public function PartEng()
    {
        return $this->hasMany(PartEng::class);
    }
}
