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
use App\Karyawan;
use App\Offline;
use App\Penawaran_ecom;
use App\Penawaran_offline;
use App\Podo_offline;
use App\Podo_online;
use App\podo_onlines;
use PDF;
use Jenssegers\Date\Date;

class PenjualanController extends Controller
{


    public function date_set($x)
    {
        $date = Date::parse($x)->isoformat('Do MMMM YYYY');
        return $date;
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
    public function detail_penjualan_ecom_data($id)
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


    public function penjualan_offline_data_select($customer_id)
    {
        $data = Offline::where('customer_id', $customer_id)
            ->get();
        echo json_encode($data);
    }

    public function penawaran_offline()
    {
        return view('page.penjualan.penawaran_offline');
    }

    public function penawaran_offline_ubah($id)
    {
        $customer = Offline::with('distributor')
            ->get();
        $karyawan = Karyawan::where('jabatan', 'direktur')
            ->get();
        $penawaran_offline = Penawaran_offline::with('karyawan', 'offline')
            ->find($id);

        return view('page.penjualan.penawaran_offline_ubah', ['customer' => $customer, 'karyawan' => $karyawan, 'penawaran_offline' => $penawaran_offline]);
    }

    public function penawaran_offline_tambah()
    {
        $customer = Offline::with('distributor')
            ->get();
        $karyawan = Karyawan::where('jabatan', 'direktur')
            ->get();
        return view('page.penjualan.penawaran_offline_tambah', ['customer' => $customer, 'karyawan' => $karyawan]);
    }
    public function penawaran_offline_data()
    {
        $data = Penawaran_offline::with('karyawan', 'offline');
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('xx', function ($data) {
                return $data->offline->distributor->nama;
            })
            ->addColumn('button', function ($data) {

                $btn = '<div class="inline-flex"><button type="button" id="detail"  data-id="' . $data->offline_id . '" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                $btn = $btn . '<a href="/penawaran_offline/cetak_penawaran/' . $data->offline_id .  '" target="_break"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-print"></i></button></a>';
                $btn = $btn . '<a href="/penawaran_offline/ubah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></a>';
                $btn = $btn . ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function  penawaran_offline_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'offline_id' => 'required|unique:penawaran_offlines',
                'deskripsi' => 'required',
                'tgl_surat' => 'required',
                'karyawan_id' => 'required'
            ],
            [
                'offline_id.unique' => "Order ID harus dipilih",
                'offline_id.required' => "Order ID harus dipilih",
                'deskripsi.required' => "Deskpripsi harus di isi",
                'tgl_surat.required' => "Tgl Surat harus di isi",
                'karyawan_id.required' => "Persetujuan harus di pilih",
            ]
        );

        $a = Penawaran_offline::create([
            'offline_id' => $request->offline_id,
            'tujuan' => $request->tujuan,
            'deskripsi' => $request->deskripsi,
            'tgl_surat' => $request->tgl_surat,
            'karyawan_id' => $request->karyawan_id
        ]);

        if ($a) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function  penawaran_offline_aksi_ubah($id, Request $request)
    {
        $this->validate(
            $request,
            [

                'deskripsi' => 'required',
                'tgl_surat' => 'required',
                'karyawan_id' => 'required'
            ],
            [

                'deskripsi.required' => "Deskpripsi harus di isi",
                'tgl_surat.required' => "Tgl Surat harus di isi",
                'karyawan_id.required' => "Persetujuan harus di pilih",
            ]
        );

        $penawaran_offline = Penawaran_offline::find($id);
        $penawaran_offline->offline_id = $request->offline_id;
        $penawaran_offline->tujuan = $request->tujuan;
        $penawaran_offline->deskripsi = $request->deskripsi;
        $penawaran_offline->tgl_surat = $request->tgl_surat;
        $penawaran_offline->karyawan_id = $request->karyawan_id;
        $penawaran_offline->save();

        if ($penawaran_offline) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }


    public function cetak_penawaran_offline($id)
    {
        $penawaran_offline = Penawaran_offline::with('karyawan', 'offline')
            ->where('offline_id', $id)
            ->first();
        $detail_offline = Detail_offline::where('offline_id', $id)
            ->get();

        $pdf = PDF::loadView('page.penjualan.surat_penawaran_offline', ['penawaran_offline' => $penawaran_offline, 'detail_offline' => $detail_offline])->setPaper('A4');
        return $pdf->stream('');
    }

    public function penawaran_ecom()
    {
        return view('page.penjualan.penawaran_ecom');
    }

    public function penawaran_ecom_data()
    {
        $data = Penawaran_ecom::with('karyawan', 'ecommerce');
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('xx', function ($data) {
                return $data->ecommerce->distributor->nama;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="detail"  data-id="' . $data->ecommerce_id . '" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                $btn = $btn . '<a href="/penawaran_ecom/cetak_penawaran/' . $data->ecommerce_id .  '" target="_break"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-print"></i></button></a>';
                $btn = $btn . '<a href="/penawaran_ecom/ubah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></a>';
                $btn = $btn . ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function penawaran_ecom_tambah()
    {
        $customer = Ecommerces::with('distributor')
            ->get();
        $karyawan = Karyawan::where('jabatan', 'direktur')
            ->get();
        return view('page.penjualan.penawaran_ecom_tambah', ['customer' => $customer, 'karyawan' => $karyawan]);
    }
    public function penjualan_ecom_data_select($customer_id)
    {
        $data = Ecommerces::where('customer_id', $customer_id)
            ->get();
        echo json_encode($data);
    }
    public function  penawaran_ecom_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'ecommerce_id' => 'required|unique:penawaran_ecoms',
                'deskripsi' => 'required',
                'tgl_surat' => 'required',
                'karyawan_id' => 'required'
            ],
            [
                'ecommerce_id.unique' => "Order ID harus dipilih",
                'ecommerce_id.required' => "Order ID harus dipilih",
                'deskripsi.required' => "Deskpripsi harus di isi",
                'tgl_surat.required' => "Tgl Surat harus di isi",
                'karyawan_id.required' => "Persetujuan harus di pilih",
            ]
        );

        $a = Penawaran_ecom::create([
            'ecommerce_id' => $request->ecommerce_id,
            'tujuan' => $request->tujuan,
            'deskripsi' => $request->deskripsi,
            'tgl_surat' => $request->tgl_surat,
            'karyawan_id' => $request->karyawan_id
        ]);

        if ($a) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function cetak_penawaran_ecom($id)
    {
        $penawaran_ecom = Penawaran_ecom::with('karyawan', 'ecommerce')
            ->where('ecommerce_id', $id)
            ->first();
        $detail_ecommerce = Detail_ecommerces::where('ecommerces_id', $id)
            ->get();

        $pdf = PDF::loadView('page.penjualan.surat_penawaran_ecom', ['penawaran_ecom' => $penawaran_ecom, 'detail_ecommerce' => $detail_ecommerce])->setPaper('A4');
        return $pdf->stream('');
    }
    public function penawaran_ecom_ubah($id)
    {
        $customer = Ecommerces::with('distributor')
            ->get();
        $karyawan = Karyawan::where('jabatan', 'direktur')
            ->get();
        $penawaran_ecom = Penawaran_ecom::with('karyawan', 'ecommerce')
            ->find($id);

        return view('page.penjualan.penawaran_ecom_ubah', ['customer' => $customer, 'karyawan' => $karyawan, 'penawaran_ecom' => $penawaran_ecom]);
    }
    public function  penawaran_ecom_aksi_ubah($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'deskripsi' => 'required',
                'tgl_surat' => 'required',
                'karyawan_id' => 'required'
            ],
            [

                'deskripsi.required' => "Deskpripsi harus di isi",
                'tgl_surat.required' => "Tgl Surat harus di isi",
                'karyawan_id.required' => "Persetujuan harus di pilih",
            ]
        );

        $penawaran_ecom = Penawaran_ecom::find($id);
        $penawaran_ecom->ecommerce_id = $request->ecommerce_id;
        $penawaran_ecom->tujuan = $request->tujuan;
        $penawaran_ecom->deskripsi = $request->deskripsi;
        $penawaran_ecom->tgl_surat = $request->tgl_surat;
        $penawaran_ecom->karyawan_id = $request->karyawan_id;
        $penawaran_ecom->save();

        if ($penawaran_ecom) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function podo_online()
    {
        return view('page.penjualan.podo_online');
    }
    public function podo_online_tambah()
    {
        $ekatjual = Ekatjual::all();
        return view('page.penjualan.podo_online_tambah', ['ekatjual' => $ekatjual]);
    }
    public function podo_online_ubah($id)
    {
        $podo_online = Podo_online::find($id);
        $ekatjual = Ekatjual::all();
        return view('page.penjualan.podo_online_ubah', ['ekatjual' => $ekatjual, 'podo_online' => $podo_online]);
    }
    public function podo_online_data_select($ak1)
    {
        $data = Ekatjual::where('ak1', $ak1)
            ->get();
        echo json_encode($data);
    }
    public function podo_online_aksi_tambah(Request $request)
    {
        if ($request->file('lampiran') > 0) {
            $this->validate(
                $request,
                [
                    'ekatjual_id' => 'required|unique:podo_onlines',
                    'po' => 'required',
                    'tglpo' => 'required',
                    'lampiran' => 'mimes:pdf|max:10000'

                ],
                [

                    'ekatjual_id.unique' => "LKPP Sudah pernah di input",
                    'ekatjual_id.required' => "LKPP harus di isi",
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi",
                    'lampiran.mimes' => "Tipe file harus berjenis PDF",
                    'lampiran.max' => "Ukuran file harus < 10 Mb"

                ]
            );
            //Upload
            $file = $request->file('lampiran')->getClientOriginalName();
            $x = $request->file('lampiran')->move(base_path('\public\file\podo_online'), $request->ekatjual_id . '-' . $file);

            $a = Podo_online::create([
                'ekatjual_id' => $request->ekatjual_id,
                'po' =>  $request->po,
                'tglpo' =>  $request->tglpo,
                'do' =>  $request->do,
                'tgldo' =>  $request->tgldo,
                'file' => $request->ekatjual_id . '-' . $file,
                'keterangan' =>  $request->keterangan,
            ]);
        } else {
            $this->validate(
                $request,
                [
                    'ekatjual_id' => 'required|unique:podo_onlines',
                    'po' => 'required',
                    'tglpo' => 'required'

                ],
                [
                    'ekatjual_id.unique' => "LKPP Sudah pernah di input",
                    'ekatjual_id.required' => "LKPP harus di isi",
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi"

                ]
            );

            $a = Podo_online::create([
                'ekatjual_id' => $request->ekatjual_id,
                'po' =>  $request->po,
                'tglpo' =>  $request->tglpo,
                'do' =>  $request->do,
                'tgldo' =>  $request->tgldo,
                'file' => $request->lampiran,
                'keterangan' =>  $request->keterangan,
            ]);
        }

        if ($a) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
    public function podo_online_aksi_ubah($id, Request $request)
    {

        if ($request->file('lampiran') > 0) {
            $this->validate(
                $request,
                [
                    'po' => 'required',
                    'tglpo' => 'required',
                    'lampiran' => 'mimes:pdf|max:10000'

                ],
                [
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi",
                    'lampiran.mimes' => "Tipe file harus berjenis PDF",
                    'lampiran.max' => "Ukuran file harus < 10 Mb"

                ]
            );
            $podo_online = Podo_online::find($id);
            //Upload
            $file = $request->file('lampiran')->getClientOriginalName();
            $x = $request->file('lampiran')->move(base_path('\public\file\podo_online'), $podo_online->ekatjual_id . '-' . $file);

            $podo_online->po =  $request->po;
            $podo_online->tglpo =  $request->tglpo;
            $podo_online->do =  $request->do;
            $podo_online->tgldo =  $request->tgldo;
            $podo_online->keterangan =  $request->keterangan;
            $podo_online->file =  $podo_online->ekatjual_id . '-' . $file;
            $podo_online->save();
        } else {
            $this->validate(
                $request,
                [
                    'po' => 'required',
                    'tglpo' => 'required'

                ],
                [
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi"
                ]
            );
            $podo_online = Podo_online::find($id);
            $podo_online->po =  $request->po;
            $podo_online->tglpo =  $request->tglpo;
            $podo_online->do =  $request->do;
            $podo_online->tgldo =  $request->tgldo;
            $podo_online->keterangan =  $request->keterangan;
            $podo_online->save();
        }

        if ($podo_online) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }

    public function podo_online_data()
    {
        $data = Podo_online::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('no_lkpp', function ($data) {
                return $data->ekatjual->lkpp;
            })
            ->addColumn('dsb', function ($data) {
                return $data->ekatjual->distributor->nama;
            })
            ->addColumn('ak1', function ($data) {
                return $data->ekatjual->ak1;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="detail"  data-id="' . $data->ekatjual->id . '" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                if ($data->file == NULL) {
                    $btn = $btn . '<a  class="disabled"  aria-disabled="true"><button type="button" class="btn btn-block btn-warning karyawan-img-small disabled" style="border-radius:50%;" ><i class="fas fa-file"></i></button></a>';
                } else {
                    $btn = $btn . '<a href="/podo_online/file' . $data->file . '" target="_break"><button type="button" class="btn btn-block btn-warning karyawan-img-small " style="border-radius:50%;" ><i class="fas fa-file"></i></button></a>';
                }
                $btn = $btn . '<a href="/podo_online/ubah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></a>';
                $btn = $btn . ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function podo_online_file($nama)
    {
        return response()->file(base_path('public/file/podo_online/' . $nama . ''));
    }
    public function podo_offline()
    {
        return view('page.penjualan.podo_offline');
    }
    public function podo_offline_data()
    {
        $data = Podo_offline::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->offline->order_id;
            })
            ->addColumn('y', function ($data) {
                return $data->offline->distributor->nama;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="detail"  data-id="' . $data->offline->id . '" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                if ($data->file == NULL) {
                    $btn = $btn . '<a  class="disabled"  aria-disabled="true"><button type="button" class="btn btn-block btn-warning karyawan-img-small disabled" style="border-radius:50%;" ><i class="fas fa-file"></i></button></a>';
                } else {
                    $btn = $btn . '<a href="/podo_offline/file' . $data->file . '" target="_break"><button type="button" class="btn btn-block btn-warning karyawan-img-small " style="border-radius:50%;" ><i class="fas fa-file"></i></button></a>';
                }
                $btn = $btn . '<a href="/podo_offline/ubah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></a>';
                $btn = $btn . ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function podo_offline_file($nama)
    {
        return response()->file(base_path('public/file/podo_offline/' . $nama . ''));
    }
    public function podo_offline_tambah()
    {
        $offline = Offline::all();
        return view('page.penjualan.podo_offline_tambah', ['offline' => $offline]);
    }
    public function podo_offline_ubah($id)
    {
        $podo_offline = Podo_offline::find($id);
        $offline = Offline::all();
        return view('page.penjualan.podo_offline_ubah', ['offline' => $offline, 'podo_offline' => $podo_offline]);
    }
    public function podo_offline_aksi_tambah(Request $request)
    {
        if ($request->file('lampiran') > 0) {
            $this->validate(
                $request,
                [
                    'offline_id' => 'required|unique:podo_offlines',
                    'po' => 'required',
                    'tglpo' => 'required',
                    'lampiran' => 'mimes:pdf|max:10000'
                ],
                [
                    'offline_id.unique' => "ID Order Sudah pernah di input",
                    'offline_id.required' => "ID Order harus di isi",
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi",
                    'lampiran.mimes' => "Tipe file harus berjenis PDF",
                    'lampiran.max' => "Ukuran file harus < 10 Mb"
                ]
            );
            //Upload
            $file = $request->file('lampiran')->getClientOriginalName();
            $x = $request->file('lampiran')->move(base_path('\public\file\podo_offline'), $request->offline_id . '-' . $file);

            $a = Podo_offline::create([
                'offline_id' => $request->offline_id,
                'po' =>  $request->po,
                'tglpo' =>  $request->tglpo,
                'do' =>  $request->do,
                'tgldo' =>  $request->tgldo,
                'file' => $request->offline_id . '-' . $file,
                'keterangan' =>  $request->keterangan,
            ]);
        } else {
            $this->validate(
                $request,
                [
                    'offline_id' => 'required|unique:podo_offlines',
                    'po' => 'required',
                    'tglpo' => 'required'
                ],
                [
                    'offline_id.unique' => "ID Order Sudah pernah di input",
                    'offline_id.required' => "ID Order harus di isi",
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi"
                ]
            );
            $a = Podo_offline::create([
                'offline_id' => $request->offline_id,
                'po' =>  $request->po,
                'tglpo' =>  $request->tglpo,
                'do' =>  $request->do,
                'tgldo' =>  $request->tgldo,
                'file' => $request->lampiran,
                'keterangan' =>  $request->keterangan,
            ]);
        }

        if ($a) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }

    public function podo_offline_aksi_ubah($id, Request $request)
    {

        if ($request->file('lampiran') > 0) {
            $this->validate(
                $request,
                [
                    'po' => 'required',
                    'tglpo' => 'required',
                    'lampiran' => 'mimes:pdf|max:10000'

                ],
                [
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi",
                    'lampiran.mimes' => "Tipe file harus berjenis PDF",
                    'lampiran.max' => "Ukuran file harus < 10 Mb"

                ]
            );
            $podo_offline = podo_offline::find($id);
            //Upload
            $file = $request->file('lampiran')->getClientOriginalName();
            $x = $request->file('lampiran')->move(base_path('\public\file\podo_offline'), $podo_offline->ekatjual_id . '-' . $file);

            $podo_offline->po =  $request->po;
            $podo_offline->tglpo =  $request->tglpo;
            $podo_offline->do =  $request->do;
            $podo_offline->tgldo =  $request->tgldo;
            $podo_offline->keterangan =  $request->keterangan;
            $podo_offline->file =  $podo_offline->ekatjual_id . '-' . $file;
            $podo_offline->save();
        } else {
            $this->validate(
                $request,
                [
                    'po' => 'required',
                    'tglpo' => 'required'

                ],
                [
                    'po.required' => "No PO harus di isi",
                    'tglpo.required' => "Tgl PO harus di isi"
                ]
            );
            $podo_offline = podo_offline::find($id);
            $podo_offline->po =  $request->po;
            $podo_offline->tglpo =  $request->tglpo;
            $podo_offline->do =  $request->do;
            $podo_offline->tgldo =  $request->tgldo;
            $podo_offline->keterangan =  $request->keterangan;
            $podo_offline->save();
        }

        if ($podo_offline) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
        }
    }
}
