<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Perakitan;
use App\HasilPerakitan;
use App\PemeriksaanRakit;

class QCController extends Controller
{
    //PRODUKSI
    public function pemeriksaan_rakit($id)
    {
        $s = PemeriksaanRakit::all();
        return view('ui.pemeriksaan_rakit.show', ['s' => $s]);
    }

    public function tambah_pemeriksaan_rakit($id)
    {
        $p = Perakitan::find($id);
        $k = Karyawan::all();
        return view('ui.perakitan.pemeriksaan_rakit.create', ['p' => $p, 'k' => $k]);
    }

    public function store_pemeriksaan_rakit($id, Request $request)
    {
        $cpr = PemeriksaanRakit::create([
                   'perakitan_id' => $id,
                   'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
                   'keterangan' => $request->keterangan,
                   'kesimpulan' => $request->kesimpulan,
                   'status' => $request->status
              ]);
        
        $chpr = HasilPemeriksaanRakit::create([
                   'pemeriksaan_rakit_id' => $cpr->id,
                   'hasil_perakitan_id' => $request->no_seri,
                   'kondisi' => $request->kondisi,
                   'tindak_lanjut' => $request->tindak_lanjut,
                   'keterangan' => $request->keterangan
                ]);

        return redirect()->back()->with();
    }
}
