<?php

namespace App\Http\Controllers;

use App\HasilPerakitan;
use App\KalibrasiInternal;
use App\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;




class LabController extends Controller
{
    public function ka_internal_tambah()
    {
        $hasil_perakitan = HasilPerakitan::all();
        $karyawan = Karyawan::where('divisi_id', '22')->get();
        return view('page.lab.ka_internal_tambah',  ['hasil_perakitan' => $hasil_perakitan, 'karyawan' => $karyawan]);
    }

    public function ka_internal_form()
    {
        //     $penawaran_offline = Penawaran_offline::with('karyawan', 'offline')
        //     ->where('offline_id', $id)
        //     ->first();
        // $detail_offline = Detail_offline::where('offline_id', $id)
        //     ->get();

        $pdf = PDF::loadView('page.lab.ka_internal_form')->setPaper('A4');
        return $pdf->stream('');
    }

    public function ka_permintaan_form()
    {
        $pdf = PDF::loadView('page.lab.ka_permintaan_form')->setPaper('A4', 'landscape');
        return $pdf->stream('');
    }
    public function lup_steril()
    {
        $pdf = PDF::loadView('page.lab.pdf_lup_steril')->setPaper('A4');
        return $pdf->stream('');
    }
}
