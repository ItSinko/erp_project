<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcuanLkpLup extends Model
{
    protected $fillable = ["format_lkp_lup_id", "nama_parameter"];

    public function FormatLkpLup()
    {
        return $this->belongsTo(FormatLkpLup::class);
    }

    public function ParameterLkpLup()
    {
        return $this->hasMany(ParameterLkpLup::class);
    }
}
