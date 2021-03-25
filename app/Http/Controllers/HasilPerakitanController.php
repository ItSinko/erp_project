<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HasilPerakitan;

class HasilPerakitanController extends Controller
{
    public function show($id)
    {
        $s = HasilPerakitan::where('perakitan_id', $id)->get();
        return $s;
    }

    public function show_detail($id)
    {
        $s = HasilPerakitan::where('id', $id)->first();
        return $s;
    }
    
    public function show_no_seri_exist($no_seri)
    {
        $s = HasilPerakitan::where('no_seri', '=', $no_seri)->count();
        return $s;
    }

    public function show_no_seri_exist_not_in($no_seri, $id)
    {
        $s = HasilPerakitan::where('no_seri', '=', $no_seri)
             ->whereNotIn('id', [$id])
             ->count();
        return $s;
    }

    public function create($perakitan_id, $tanggal, $no_seri, $warna, $kondisi, $keterangan)
    {
        $c = HasilPerakitan::create([
                'perakitan_id' => $perakitan_id,
                'tanggal' => $tanggal,
                'no_seri' => $no_seri,
                'warna' => $warna,
                'kondisi' => $kondisi,
                'keterangan' => $keterangan
             ]);
        
        return $c;
    }

    public function count_hasil_perakitan_by_bppb($id)
    {
        $c = HasilPerakitan::where('bppb_id', $id)
             ->join('perakitans', 'hasil_perakitans.perakitan_id', '=', 'perakitans.id')
             ->join('bppbs', 'perakitans.bppb_id', 'bppbs.id')
             ->select('hasil_perakitans.id')
             ->count();
    
        return $c;
    }
}
