<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = "parts";
    protected $primaryKey = "kode";
    protected $fillable = ['nama', 'kode', 'jumlah', 'foto'];

    protected $keyType = "string";
    public $incrementing = false;

    public function PartEng()
    {
        return $this->hasMany(PartEng::class);
    }
}
