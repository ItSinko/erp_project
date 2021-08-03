<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;




class LabController extends Controller
{
    public function ka_internal_tambah()
    {
        return view('page.lab.ka_internal_tambah');
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
