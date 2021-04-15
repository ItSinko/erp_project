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
use Romans\Filter\InttoRoman;
use App\Spaon;
use App\Distributor;
use App\Produk;
use App\Ekatjual;
use App\Detail_ekatjual;
use App\Detail_offline;
use App\Ecommerces;
use App\Offline;
use PDF;

class PenjualanController extends Controller
{
    public function tes()
    {
        $pdf = PDF::loadView('page.penjualan.penawaran_offline');
        return $pdf->download('laporan-pegawai-pdf');
    }
    public function penjualan_online()
    {
        $produk = Produk::all();
        return view('page.penjualan.online', ['produk' => $produk]);
    }
    public function penjualan_online_ecom()
    {
        return view('page.penjualan.ecom');
    }
    public function penjualan_online_ecom_data()
    {
        $data = Ecommerces::with('distributor');
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
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
    public function detail_penjualan_online_ecom_data($id)
    {

        $data = Detail_ecommerces::with('produk')
            ->where('ecommerces_id', $id);
        return datatables::of($data)
            ->editColumn('total', function ($data) {
                return $data->harga * $data->jumlah;
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function detail_penjualan_offline_data($id)
    {
        $data = Detail_offline::with('produk')
            ->where('offline_id', $id);
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

    public function penjualan_online_aksi_ubah($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'distributor_id' => 'required',
                'ak1' => 'required',
                'instansi' => 'required',
                'satuankerja' => 'required',
                'status' => 'required',
                'tglbuat' => 'required',
                'despaket' => 'required',
            ],
            [
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

        $ekatjual                 = Ekatjual::find($id);
        $ekatjual->lkpp           = $request->lkpp;
        $ekatjual->distributor_id = $request->distributor_id;
        $ekatjual->ak1            = $request->ak1;
        $ekatjual->despaket       = $request->despaket;
        $ekatjual->instansi       = $request->instansi;
        $ekatjual->satuankerja    = $request->satuankerja;
        $ekatjual->status         = $request->status;
        $ekatjual->tglbuat        = $request->tglbuat;
        $ekatjual->tgledit        = $request->tgledit;
        $ekatjual->save();

        if ($ekatjual) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function penjualan_online_detail_aksi_ubah(Request $request)
    {
        $this->validate(
            $request,
            [
                'harga' => 'required',
                'jumlah' => 'required',
            ],
            [
                'harga.required' => "Harga Produk harus diisi",
                'jumlah.required' => "Jumlah Produk harus diisi",
            ]
        );
        $id = $request->id;
        $detail_ekatjual = Detail_ekatjual::find($id);
        $detail_ekatjual->jumlah = $request->jumlah;
        $detail_ekatjual->harga = $request->harga;
        $detail_ekatjual->produk_id = $request->produk_id;
        $detail_ekatjual->ekatjuals_id = $request->ekatjuals_id;
        $detail_ekatjual->save();

        if ($detail_ekatjual) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }

    public function penjualan_offline_detail_aksi_ubah(Request $request)
    {
        $this->validate(
            $request,
            [
                'harga' => 'required',
                'jumlah' => 'required',
            ],
            [
                'harga.required' => "Harga Produk harus diisi",
                'jumlah.required' => "Jumlah Produk harus diisi",
            ]
        );
        $id = $request->id;
        $Detail_offline = Detail_offline::find($id);
        $Detail_offline->jumlah = $request->jumlah;
        $Detail_offline->harga = $request->harga;
        $Detail_offline->produk_id = $request->produk_id;
        $Detail_offline->offline_id = $request->offline_id;
        $Detail_offline->keterangan = $request->keterangan;
        $Detail_offline->save();

        if ($Detail_offline) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }

    public function detail_penjualan_online_ecom_aksi_ubah(Request $request)
    {
        $this->validate(
            $request,
            [
                'harga' => 'required',
                'jumlah' => 'required',
            ],
            [
                'harga.required' => "Harga Produk harus diisi",
                'jumlah.required' => "Jumlah Produk harus diisi",
            ]
        );

        $id = $request->id;
        $Detail_ecommerces = Detail_ecommerces::find($id);
        $Detail_ecommerces->jumlah = $request->jumlah;
        $Detail_ecommerces->harga = $request->harga;
        $Detail_ecommerces->produk_id = $request->produk_id;
        $Detail_ecommerces->ecommerces_id = $request->ecommerces_id;
        $Detail_ecommerces->keterangan = $request->keterangan;
        $Detail_ecommerces->save();

        if ($Detail_ecommerces) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function penjualan_online_detail_edit($id)
    {
        $data = Detail_ekatjual::with('produk')
            ->where('id', $id)
            ->get();
        echo json_encode($data);
    }
    public function penjualan_offline_detail_edit($id)
    {
        $data = Detail_offline::with('produk')
            ->where('id', $id)
            ->get();
        echo json_encode($data);
    }
    public function detail_penjualan_online_ecom_data_edit($id)
    {
        $data = Detail_ecommerces::with('produk')
            ->where('id', $id)
            ->get();
        echo json_encode($data);
    }
    public function penjualan_online_ecom_tambah()
    {
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.online_ecom_tambah', ['distributor' => $distributor, 'produk' => $produk]);
    }
    public function penjualan_online_ecom_ubah($id)
    {
        $ecommerces = Ecommerces::with('distributor')
            ->find($id);
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.online_ecom_ubah', ['distributor' => $distributor, 'produk' => $produk, 'ecommerces' => $ecommerces]);
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

        $x = Ecommerces::max('id') + 1;
        $y = Carbon::now()->format('Y');
        $m = Carbon::now()->format('m');
        $filter = new IntToRoman();

        if ($request->market == 'Tokopedia') {
            $c = 'TKPD';
        } else if ($request->market == 'Bli Bli') {
            $c = 'BLI';
        } else {
            $c = 'INDO';
        }
        $a = 'ECOM/' . $c . '/' . $filter->filter($m) . '/' . $y . '/' . $x;

        $ecommerces = Ecommerces::create([
            'order_id' =>  $a,
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



    public function penjualan_online_ecom_aksi_ubah($id, Request $request)
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

        $ecommerces = Ecommerces::find($id);
        $ecommerces->order_id = $request->order_id;
        $ecommerces->market = $request->market;
        $ecommerces->customer_id = $request->customer_id;
        $ecommerces->status = $request->status;
        $ecommerces->bayar = $request->bayar;
        $ecommerces->save();



        if ($ecommerces) {
            return redirect()->back()->with(["succes" => "Berhasil menambahkan data"]);
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
    public function penjualan_offline()
    {
        $produk = Produk::all();
        return view('page.penjualan.offline', ['produk' => $produk]);
    }
    public function penjualan_offline_data()
    {
        $data = Offline::with('distributor');
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function penjualan_offline_tambah()
    {
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.offline_tambah', ['distributor' => $distributor, 'produk' => $produk]);
    }
    public function penjualan_offline_ubah($id)
    {
        $offline = Offline::with('distributor')
            ->find($id);
        $distributor = Distributor::all();
        $produk = Produk::all();
        return view('page.penjualan.offline_ubah', ['distributor' => $distributor, 'produk' => $produk, 'offline' => $offline]);
    }
    public function penjualan_offline_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'customer_id' => 'required',
                'status' => 'required',
                'bayar' => 'required',
            ],
            [
                'customer_id.required' => "Customer harus dipilih",
                'status.required' => "Status pesanan harus diisi",
                'bayar.required' => "Jenis pembayaran harus diisi",
            ]
        );

        $x = Offline::max('id') + 1;
        $y = Carbon::now()->format('Y');
        $m = Carbon::now()->format('m');
        $filter = new IntToRoman();


        $a = 'OFF/' . $filter->filter($m) . '/' . $y . '/' . $x;

        $offline = Offline::create([
            'order_id' =>  $a,
            'customer_id' =>  $request->customer_id,
            'status' =>  $request->status,
            'bayar' =>  $request->bayar,
        ]);

        for ($i = 0; $i < count($request->produk_id); $i++) {
            $yeye = Detail_offline::create([
                'offline_id' => $offline->id,
                'produk_id' => $request->produk_id[$i],
                'harga' => $request->harga[$i],
                'jumlah' => $request->jumlah[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }
        if ($offline) {
            return redirect()->back()->with(["succes" => "Berhasil menambahkan data"]);
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
    public function penjualan_offline_aksi_ubah($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'customer_id' => 'required',
                'status' => 'required',
                'bayar' => 'required',
            ],
            [
                'customer_id.required' => "Customer harus dipilih",
                'status.required' => "Status pesanan harus diisi",
                'bayar.required' => "Jenis pembayaran harus diisi",
            ]
        );

        $offline = Offline::find($id);
        $offline->order_id = $request->order_id;
        $offline->customer_id = $request->customer_id;
        $offline->status = $request->status;
        $offline->bayar = $request->bayar;
        $offline->save();

        if ($offline) {
            return redirect()->back()->with(["succes" => "Berhasil menambahkan data"]);
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }
}
