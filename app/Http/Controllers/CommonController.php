<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

use App\Jasa_eks;
use App\Distributor;
use App\Paket_produk;
use App\Produk;

class CommonController extends Controller
{
    public function jasa_eks()
    {
        return view('page.common.jasa_eks');
    }
    public function jasa_eks_tambah()
    {
        return view('page.common.jasa_eks_tambah');
    }
    public function jasa_eks_ubah($id)
    {
        $jasa = Jasa_eks::find($id);
        return view('page.common.jasa_eks_ubah', ['jasa' => $jasa]);
    }

    public function jasa_eks_data()
    {
        $data = Jasa_eks::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function jasa_eks_aksi_tambah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:jasa_ekss',
            'via' => 'required'
        ], [
            'nama.required' => "Nama distributor harus diisi",
        ]);

        $jasa = Jasa_eks::create([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'via' => $request->via,
            'jur' => $request->jur,
            'ket' => $request->ket
        ]);
        if ($jasa) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
    public function jasa_eks_aksi_ubah($id, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'via' => 'required'
        ], [
            'nama.required' => "Nama distributor harus diisi",
        ]);
        $jasa = Jasa_eks::find($id);
        $jasa->nama = $request->nama;
        $jasa->telp = $request->telp;
        $jasa->alamat = $request->alamat;
        $jasa->via = $request->via;
        $jasa->jur = $request->jur;
        $jasa->ket = $request->ket;
        $jasa->save();
        if ($jasa) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }


    public function nama_alamat()
    {
        return view('page.common.nama_alamat');
    }
    public function nama_alamat_tambah()
    {
        return view('page.common.nama_alamat_tambah');
    }
    public function nama_alamat_aksi_tambah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:distributors',
            'jenis' => 'required',
            'dis_nota' => 'required',
            'dis_uji' => 'required',
            'tempo' => 'required'
        ], [
            'nama.required' => "Nama distributor harus diisi",
            'jenis.required' => "Jenis distributor harus diisi",
            'dis_nota.required' => "Diskon Nota harus diisi",
            'dis_uji.required' => "Diskon Uji harus di isi",
            'tempo.required' => "Tempo pembayaran harus di isi",
        ]);

        $distributor = Distributor::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
            'dis_uji' => $request->dis_uji,
            'dis_nota' => $request->dis_nota,
            'tempo' => $request->tempo,
        ]);
        if ($distributor) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
    public function nama_alamat_ubah($id)
    {
        $nama_alamat = Distributor::find($id);
        return view('page.common.nama_alamat_ubah', ['nama_alamat' => $nama_alamat]);
    }
    public function nama_alamat_data()
    {
        $data = Distributor::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function nama_alamat_aksi_ubah($id, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis' => 'required',
            'dis_nota' => 'required',
            'dis_uji' => 'required',
            'tempo' => 'required'
        ], [
            'nama.required' => "Nama distributor harus diisi",
            'jenis.required' => "Jenis harus diisi",
            'dis_nota.required' => "Diskon Nota harus di isi",
            'dis_uji.required' => "Diskon Uji harus diisi",
            'tempo.required' => "Tempo Bayar harus diisi"
        ]);

        $distributor = Distributor::find($id);
        $distributor->nama = $request->nama;
        $distributor->jenis = $request->jenis;
        $distributor->telp = $request->telp;
        $distributor->alamat = $request->alamat;
        $distributor->email = $request->email;
        $distributor->dis_nota = $request->dis_nota;
        $distributor->dis_uji = $request->dis_uji;
        $distributor->tempo = $request->tempo;
        $distributor->ket = $request->ket;
        $distributor->save();

        if ($distributor) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }

    public function produk_get_select($id)
    {
        $data = Produk::where('id', $id)->get();
        echo json_encode($data);
    }

    public function penjualan_produk()
    {
        $data = Paket_produk::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
