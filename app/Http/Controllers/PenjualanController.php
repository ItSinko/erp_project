<?php

namespace App\Http\Controllers;

use App\Detail_ecommerces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use App\Spaon;
use App\Distributor;
use App\Produk;
use App\Ekatjual;
use App\Detail_ekatjual;
use App\Ecommerces;

class PenjualanController extends Controller
{
    public function penjualan_online()
    {
        $produk = Produk::all();
        return view('page.penjualan.online', ['produk' => $produk]);
    }
    public function penjualan_online_ecom()
    {
        return view('page.penjualan.ecom');
    }
    public function penjualan_online_data()
    {
        $data = Ekatjual::with('distributor');
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function detail_penjualan_online_data($id)
    {

        $data = Detail_ekatjual::with('produk')
            ->where('ekatjuals_id', $id);
        return datatables::of($data)
            ->editColumn('total', function ($data) {
                return $data->harga * $data->jumlah;
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function penjualan_online_tambah()
    {
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.online_tambah', ['distributor' => $distributor, 'produk' => $produk]);
    }
    public function penjualan_online_ubah($id)
    {
        $ekatjual = Ekatjual::find($id);
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.online_ubah', ['distributor' => $distributor, 'produk' => $produk, 'ekatjual' => $ekatjual]);
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
                'lkpp' => 'required|unique:ekatjuals',
                'distributor_id' => 'required',
                'ak1' => 'required',
                'instansi' => 'required',
                'satuankerja' => 'required',
                'status' => 'required',
                'tglbuat' => 'required',
                'despaket' => 'required',
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
                'tglbuat.required' => 'Tgl Buat harus diisi',
                'produk_id.required' => 'Produk harus dipilih'
            ]
        );
        $ak = 'AK1-P';
        $ekatjual = Ekatjual::create([
            'lkpp' =>  $request->lkpp,
            'distributor_id' => $request->distributor_id,
            'ak1' => $ak . $request->ak1,
            'despaket' => $request->despaket,
            'instansi' => $request->instansi,
            'satuankerja' => $request->satuankerja,
            'status' => $request->status,
            'tglbuat' => $request->tglbuat,
            'tgledit' => $request->tgledit,
        ]);
        for ($i = 0; $i < count($request->produk_id); $i++) {
            $yeye = Detail_ekatjual::create([
                'ekatjuals_id' => $ekatjual->id,
                'produk_id' => $request->produk_id[$i],
                'harga' => $request->harga[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }
        if ($ekatjual) {
            return redirect()->back()->with(["succes" => "Berhasil menambahkan data"]);
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
    public function  penjualan_online_detail_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'produk_id' => 'required',
            ],
            [
                'produk_id.required' => "Tipe Produk harus diisi",
            ]
        );
        for ($i = 0; $i < count($request->produk_id); $i++) {
            $a = Detail_ekatjual::create([
                'ekatjuals_id' => $request->fk_paket_produk,
                'produk_id' => $request->produk_id[$i],
                'harga' => $request->harga[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }
        if ($a) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function penjualan_online_ecom_tambah()
    {
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.online_ecom_tambah', ['distributor' => $distributor, 'produk' => $produk]);
    }

    public function penjualan_online_ecom_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'market' => 'required',
                'customer_id' => 'required',
                'status' => 'required',
                'bayar' => 'required',

            ],
            [
                'market.required' => "Market Asal harus diisi",
                'customer_id.required' => "Customer harus dipilih",
                'status.required' => "Status pesanan harus diisi",
                'bayar.required' => "Jenis pembayaran harus diisi",


            ]
        );

        $x = Ecommerces::max('id');
        $y = Carbon::now();

        $ecommerces = Ecommerces::create([
            'order_id' =>  'a',
            'market' =>  $request->market,
            'customer_id' =>  $request->customer_id,
            'status' =>  $request->status,
            'bayar' =>  $request->bayar,
        ]);

        for ($i = 0; $i < count($request->produk_id); $i++) {
            $yeye = Detail_ecommerces::create([
                'ecommerces_id' => $ecommerces->id,
                'produk_id' => $request->produk_id[$i],
                'harga' => $request->harga[$i],
                'jumlah' => $request->jumlah[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }
        if ($ecommerces) {
            return redirect()->back()->with(["succes" => "Berhasil menambahkan data"]);
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
}
