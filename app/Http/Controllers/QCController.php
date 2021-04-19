<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bppb;
use App\Karyawan;
use App\Perakitan;
use App\HasilPerakitan;
use App\PemeriksaanRakit;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class QCController extends Controller
{
    //PRODUKSI
    // public function pemeriksaan_rakit($id)
    // {
    //     // $s = PemeriksaanRakit::all();
    //     // return view('ui.pemeriksaan_rakit.show', ['s' => $s]);
    // }

    public function perakitan_pemeriksaan()
    {
        return view('page.qc.perakitan_pemeriksaan_show');
    }

    public function perakitan_pemeriksaan_show()
    {
        $p = Bppb::whereHas('Perakitan', function ($q) {
            $q->whereNotIn('status', ['0']);
        })->get();

        return DataTables::of($p)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }
                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('jumlah', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6><div class="subheading "><small class="purple-text">Produksi saat ini: ' . $s->countHasilPerakitan() . ' ' . $s->DetailProduk->satuan . '</small></div></hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/perakitan/laporan/' . $s->id . '" data-id="' . $s->id . '">';
                $btn .= '<button type="button" class="rounded-pill btn btn-sm btn-info">';
                $btn .= '<span style="color:white;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Detail Laporan</span></button></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan'])
            ->make(true);
    }

    public function perakitan_pemeriksaan_laporan()
    {
        return view('page.qc.perakitan_pemeriksaan_laporan_show');
    }

    public function perakitan_pemeriksaan_laporan_show($id)
    {
        $s = Perakitan::whereHas('Bppb', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->whereNotIn('status', ['0'])->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('jumlah', function ($s) {
                $btn = HasilPerakitan::where('perakitan_id', $s->id)->count();
                return $btn . " " . $s->Bppb->DetailProduk->satuan;
            })
            ->addColumn('status', function ($s) {
                $btn = "";
                if ($s->status == '12') {
                    $btn = '<span class="warning-text">
                        Periksa
                    </span>';
                    //     $btn = '<div class="inline-flex">
                    //     <a href = "/perakitan/laporan/status/' . $s->id . '/dibuat">
                    //         <button type="button" class="btn btn-block btn-outline-info karyawan-img-small" style="border-radius:50%;" title="Kirim Laporan ke Quality Control"><i class="far fa-paper-plane"></i></button>
                    //     </a>
                    // </div>';
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/perakitan/hasil/' . $s->id . '"><button class="btn btn-info circle-button btn-circle-sm m-1 karyawan-img-small"><i class="fas fa-eye"></i></button></a>';
                $btn .= '<a href = "/perakitan/laporan/edit/' . $s->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1 karyawan-img-small"><i class="fas fa-edit"></i></button></a>';
                $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/perakitan/laporan/delete/' . $s->id . '"><button class="btn btn-danger karyawan-img-small btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }

    public function tambah_pemeriksaan_rakit($id)
    {
        // $p = Perakitan::find($id);
        // $k = Karyawan::all();
        // return view('ui.perakitan.pemeriksaan_rakit.create', ['p' => $p, 'k' => $k]);
    }

    public function store_pemeriksaan_rakit($id, Request $request)
    {
        // $cpr = PemeriksaanRakit::create([
        //     'perakitan_id' => $id,
        //     'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
        //     'keterangan' => $request->keterangan,
        //     'kesimpulan' => $request->kesimpulan,
        //     'status' => $request->status
        // ]);

        // $chpr = HasilPemeriksaanRakit::create([
        //     'pemeriksaan_rakit_id' => $cpr->id,
        //     'hasil_perakitan_id' => $request->no_seri,
        //     'kondisi' => $request->kondisi,
        //     'tindak_lanjut' => $request->tindak_lanjut,
        //     'keterangan' => $request->keterangan
        // ]);

        // return redirect()->back()->with();
    }
}
