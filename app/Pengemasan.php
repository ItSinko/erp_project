<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengemasan extends Model
{
    protected $fillable = ['bppb_id', 'pic_id', 'karyawan_id', 'tanggal', 'status', 'alias_barcode'];
    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function HasilPengemasan()
    {
        return $this->hasMany(HasilPengemasan::class);
    }

    public function countHasilPengemasanStatus($status)
    {
        $id = $this->id;
        $h = HasilPengemasan::where('pengemasan_id', $id)->whereIn('status', [$status])->count();
        return $h;
    }
}
