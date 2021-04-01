<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

use App\Spaon;
use App\Distributor;
use App\Produk;
use App\Ekatjual;
use App\Detail_ekatjual;

class PenjualanController extends Controller
{
    public function penjualan_online()
    {
        return view('page.penjualan.online');
    }
    public function penjualan_online_data()
    {
        $data = Ekatjual::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function penjualan_online_tambah()
    {
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.online_tambah', ['distributor' => $distributor, 'produk' => $produk]);
    }
    public function penjualan_online_cek_data($lkpp)
    {
        $data = Ekatjual::where('lkpp', $lkpp)->get();
        echo json_encode($data);
    }

    public function penjualan_online_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'lkpp' => 'required|unique:spaons',
                'distributor_id' => 'required',
                'ak1' => 'required',
                'instansi' => 'required',
                'satuankerja' => 'required',
                'status' => 'required',
                'tglbuat' => 'required',
                'despaket' => 'required'
            ],
            [
                'lkpp.required' => "LKPP harus diisi",
                'lkpp.unique'   => "LKPP sudah terpakai",
                'distributor_id.required' => "Distributor harus dipilih",
                'ak1.required' => 'No AK1 harus diisi',
                'despaket.required' => 'Deskripsi pemesanan paket harus diisi',
                'instansi.required' => 'Instansi harus diisi',
                'satuankerja.required' => 'Satuan Kerja harus diisi',
                'status.required' => 'Status harus dipilih',
                'tglbuat.required' => 'Tgl Buat harus diisi'
            ]
        );

        for ($i = 0; $i < count($request->produk_id); $i++) {
            $yeye = Detail_ekatjual::create([
                'ekatjual' => 2,
                'produk_id' => $request->type_produk[$i],
                'harga' => $request->harga_produk[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }
        $ekatjual = Ekatjual::create([
            'lkpp' =>  $request->lkpp,
            'distributor_id' => $request->distributor_id,
            'ak1' => $request->ak1,
            'despaket' => $request->despaket,
            'instansi' => $request->instansi,
            'satuankerja' => $request->satuankerja,
            'status' => $request->status,
            'tglbuat' => $request->tglbuat,
            'tgledit' => $request->tgledit,
        ]);

        if ($ekatjual) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
}
