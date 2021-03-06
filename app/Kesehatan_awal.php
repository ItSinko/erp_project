<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kesehatan_awal extends Model
{
    protected $table = 'kesehatan_awals';
    protected $primaryKey = 'id';
    protected $fillable = ['karyawan_id', 'vaksin', 'ket_vaksin', 'tinggi', 'berat', 'lemak', 'kandungan_air', 'otot', 'tulang', 'kalori', 'status_mata', 'mata_kiri', 'mata_kanan', 'suhu', 'spo2', 'pr', 'sistolik', 'diastolik', 'file_mcu'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
}
