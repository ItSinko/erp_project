<?php

namespace App\Http\Controllers;

use App\daftar_part;
use App\Bppb;
use App\HasilPerakitan;
use App\Kalibrasi;
use App\KalibrasiInternal;
use App\Karyawan;
use App\ListKalibrasi;
use App\ListKalibrasiInternal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class LabController extends Controller
{
    public function kalibrasi()
    {
        return view('page.lab.kalibrasi');
    }
    public function acc_kalibrasi()
    {
        return view('page.lab.acc_kalibrasi');
    }
    public function kalibrasi_data()
    {
        $data = Bppb::whereHas('kalibrasi')->with('detailproduk')->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('gambar', function ($data) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($data->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($data->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $data->foto . '"';
                }
                $gambar .= 'title="' . $data->nama . '">';
                return $gambar;
            })
            ->addColumn('jumlah_kalibrasi', function ($data) {
                $btn = '<hgroup>
                <h6 class="heading">' . $data->jumlah . " " . $data->DetailProduk->satuan . '</h6>
                <div class="subheading "><small class="info-text">Pengujian: 7 ' . $data->DetailProduk->satuan . '</small></div>
                </hgroup>';
                return $btn;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><a href="/kalibrasi/tambah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-balance-scale"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['button', 'gambar', 'jumlah_kalibrasi'])
            ->make(true);
    }
    public function acc_kalibrasi_data()
    {
        $data = Kalibrasi::with('bppb.detailproduk.produk')->where('no_pendaftaran', '!=', NULL)->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('order', function ($data) {
                return 'LAB - ' . $data->no_pendaftaran;
            })
            ->addColumn('gambar', function ($data) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($data->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($data->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $data->foto . '"';
                }
                $gambar .= 'title="' . $data->nama . '">';
                return $gambar;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="detail"  class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;" ><i class="fa fa-eye" aria-hidden="true"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button', 'gambar'])
            ->make(true);
    }
    public function acc_list_kalibrasi_data()
    {
        $data = ListKalibrasi::where('kalibrasi_id', '8')->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cetak', function ($data) {
                $btn = '<div class="inline-flex"><a href="/kalibrasi/cetak" target="_blank"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-print"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['cetak'])
            ->make(true);
    }
    public function kalibrasi_tambah($id)
    {
        $kalibrasi = Kalibrasi::find($id);
        $no = str_pad(1, 4, '0', STR_PAD_LEFT);

        $listkalibrasi = ListKalibrasi::has('Kalibrasi')->whereHas('kalibrasi', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->get();

        $karyawan = Karyawan::where('divisi_id', '22')->get();

        return view('page.lab.kalibrasi_tambah',  ['listkalibrasi' => $listkalibrasi, 'karyawan' => $karyawan, 'kalibrasi' => $kalibrasi, 'no' => $no]);
    }
    public function ka_internal_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'no_pendaftaran' => 'required',
                'teknisi_id' => 'required',
                'tanggal_kalibrasi' => 'required',
                'tanggal_selesai' => 'required',
                'tanggal_penyerahan' => 'required'
            ],
            [
                'no_pendaftaran.required' => 'No Pendaftaan',
                'teknisi_id.required' => 'Harap memilih penguji',
                'tanggal_kalibrasi' => 'Tgl Kalibrasi',
                'tanggal_selesai' => 'Tgl Selesai',
                'tanggal_penyerahan' => 'Tgl Penyerahan',
            ]
        );
        //Kalibrasi
        $id = 8;
        $kalibrasi = Kalibrasi::find($id);
        $kalibrasi->no_pendaftaran = $request->no_pendaftaran;
        $kalibrasi->save();

        //List Kalibrasi
        $listkalibrasi = ListKalibrasi::where('kalibrasi_id', $id)
            ->update([
                'teknisi_id' => $request->teknisi_id,
                'tanggal_kalibrasi' => $request->tanggal_kalibrasi,
                'tanggal_selesai' => $request->tanggal_selesai,
                'tanggal_penyerahan' => $request->tanggal_penyerahan,
                'hasil' => 'ok',
                'tindak_lanjut' => 'ok',
                'status' => 'acc_kalibrasi',
            ]);

        if ($listkalibrasi && $kalibrasi) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
    public function detail_seri_kalibrasi($kalibrasi_internal_id)
    {
        $data = Kalibrasi::with('Bppb.detailproduk.produk')
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
