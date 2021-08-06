<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterLkpLup extends Model
{
    protected $fillable = ["acuan_lkp_lup_id", "nilai_parameter"];

    public function AcuanLkpLup()
    {
        return $this->belongsTo(AcuanLkpLup::class);
    }
}
