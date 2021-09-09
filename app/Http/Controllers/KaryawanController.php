<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;


class KaryawanController extends Controller
{
    public function karyawan()
    {
        $karyawan = Divisi::all();
        return view('page.karyawan.karyawan', ['karyawan' => $karyawan]);
    }
    public function karyawan_data()
    {
        $data = Karyawan::orderBy('nama', 'ASC');
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->divisi->nama;
            })
            ->addColumn('umur', function ($data) {
                $tgl  = $data->tgllahir;
                $age = Carbon::parse($tgl)->diff(Carbon::now())->y;
                return $age . " Thn";
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="edit" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function karyawan_aksi_ubah(Request $request)
    {
        $id = $request->id;
        $karyawan = karyawan::find($id);
        $karyawan->tgllahir = $request->tgllahir;
        $karyawan->divisi_id = $request->divisi;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->kelamin = $request->jenis;
        $karyawan->save();

        if ($karyawan) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
}
