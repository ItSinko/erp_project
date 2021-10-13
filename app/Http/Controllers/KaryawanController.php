<?php

namespace App\Http\Controllers;

use App\User;
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
    public function karyawan_tambah()
    {
        $divisi = Divisi::all();
        return view('page.karyawan.karyawan_tambah', ['divisi' => $divisi]);
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
        $karyawan->pemeriksa_rapid = $request->pemeriksa_rapid;
        $karyawan->save();
        if ($karyawan) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
    public function karyawan_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|unique:karyawans',
                'divisi_id' => 'required',
                'tgllahir' => 'required',
                'tgl_kerja' => 'required',
                'jenis' => 'required',
                'jabatan' => 'required',
            ],
            [
                'nama.required' => 'Nama harus di isi',
                'divisi_id.required' => 'Divisi harus di isi',
                'tgllahir.required' => 'Tgl Lahir harus di isi',
                'tgl_kerja.required' => 'Tgl Kerja harus di isi',
                'jenis.required' => 'Jenis Kelamin  harus di isi',
                'jabatan.required' => 'Jabatan harus di isi',
            ]
        );
        $karyawan = Karyawan::create([
            'nama' => $request->nama,
            'divisi_id' => $request->divisi_id,
            'tgllahir' => $request->tgllahir,
            'tgl_kerja' => $request->tgl_kerja,
            'kelamin' => $request->jenis,
            'jabatan' => $request->jabatan,
        ]);
        if ($karyawan) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
    public function karyawan_cekdata($nama)
    {
        $data = Karyawan::where('nama', $nama)->get();
        echo json_encode($data);
    }
}
