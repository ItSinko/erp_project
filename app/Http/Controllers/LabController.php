<?php

namespace App\Http\Controllers;

use App\daftar_part;
use App\Bppb;
use App\HasilPerakitan;
use App\KalibrasiInternal;
use App\Karyawan;
use App\ListKalibrasiInternal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;




class LabController extends Controller
{
    public function ka_internal_tambah()
    {
        $listkalibrasiinternal = ListKalibrasiInternal::has('KalibrasiInternal')->get();
        $karyawan = Karyawan::where('divisi_id', '22')->get();
        return view('page.lab.ka_internal_tambah',  ['listkalibrasiinternal' => $listkalibrasiinternal, 'karyawan' => $karyawan]);
    }

    public function detail_seri_kalibrasi($kalibrasi_internal_id)
    {
        $data = KalibrasiInternal::with('Bppb.detailproduk.produk')
            ->where('id', $kalibrasi_internal_id)
            ->get();
        echo json_encode($data);
    }

    public function ka_internal_form()
    {
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
