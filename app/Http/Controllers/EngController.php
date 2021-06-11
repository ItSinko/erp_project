<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Events\Notification;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Produk;
use App\DokumenEng;
use App\HasilPerakitan;
use App\Ecommerces;
use App\HasilMonitoringProses;
use App\HasilPengemasan;
use DirectoryIterator;
use App\PerbaikanProduksi;
use App\AnalisaPsPerakitan;
use App\AnalisaPsPengujian;
use App\AnalisaPsPengemasan;
use App\BillOfMaterial;
use App\PermintaanBahanBaku;
use App\HistoriHasilPerakitan;
use App\DetailPermintaanBahanBaku;

class EngController extends Controller
{
    public function fileupload(Request $request)
    {
        if ($request->hasFile('file')) {

            // Upload path
            $destinationPath = 'files/';

            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg", "jpg", "png", "pdf");

            // Check extension
            if (in_array(strtolower($extension), $validextensions)) {

                // Rename file 
                $fileName = $request->file('file')->getClientOriginalName() . time() . '.' . $extension;
                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);
            }
        }
    }

    public function upload_file(Request $request)
    {
        $file = $request->file('file');
        $file->move('/document//' . $request->produk . '/' . $request->doc, $file->getClientOriginalName());
        return $file;
    }

    public function test()
    {
        $data = Produk::select('nama')->get();
        $dokumen = DokumenEng::all();
        return view('page.engineering.index', ['data' => $data, 'dokumen' => $dokumen]);
    }

    public function show_list($produk = null, $document = null)
    {
        // $list = Storage::disk('document')->put('dokumen/test/test2.txt', 'content');
        $result = Storage::disk('document')->files('/' . $produk . '/' . $document);
        $data = new Collection;
        for ($i = 0; $i < count($result); $i++) {
            $data->push([
                'nama' => basename($result[$i]),
                'link' => asset($result[$i]),
            ]);
        }
        // $data = Ecommerces::all();
        return datatables::of($data)->addIndexColumn()->make(true);
        // return $result;
    }

    // function DC SPA
    public function index()
    {
        $document = [];
        return view('page.engineering.home', compact('documents', 'activities', 'tagCounts', 'documentCounts', 'filesCounts'));
    }

    public function perakitan()
    {
        return view('page.engineering.perakitan_show');
    }

    public function perakitan_show()
    {
        $id = Auth::user()->id;
        // $hp1 = HasilPerakitan::whereHas('Perakitan.Bppb.DetailProduk.Produk', function ($q) use ($id) {
        //     $q->where('ppic_id', $id);
        // })->where('tindak_lanjut_terbuka', '=', 'produk_spesialis')->orWhereIn('status', ['analisa_pemeriksaan_terbuka_ps', 'analisa_pemeriksaan_tertutup_ps', 'rej_pemeriksaan_terbuka', 'rej_pemeriksaan_tertutup'])->get();

        // $hp2 = HasilPerakitan::whereHas('Perakitan.Bppb.DetailProduk.Produk', function ($q) use ($id) {
        //     $q->where('ppic_id', $id);
        // })->where('tindak_lanjut_tertutup', '=', 'produk_spesialis')->orWhereIn('status', ['analisa_pemeriksaan_terbuka_ps', 'analisa_pemeriksaan_tertutup_ps'])->get();

        $hp = HasilPerakitan::whereHas('HistoriHasilPerakitan', function ($q) {
            $q->where([
                ['tindak_lanjut', '=', 'produk_spesialis'],
                ['kegiatan', '=', 'pemeriksaan_terbuka']
            ])->orWhere([
                ['tindak_lanjut', '=', 'produk_spesialis'],
                ['kegiatan', '=', 'pemeriksaan_tertutup']
            ]);
        })->whereHas('Perakitan.Bppb.DetailProduk.Produk', function ($q) use ($id) {
            $q->where('ppic_id', $id);
        })->get();


        // $hp = $hp1->merge($hp2);
        return DataTables::of($hp)
            ->addIndexColumn()
            ->addColumn('no_bppb', function ($s) {
                return $s->Perakitan->Bppb->no_bppb;
            })
            ->editColumn('no_seri', function ($s) {
                return $s->Perakitan->alias_tim . $s->no_seri;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->Perakitan->Bppb->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->Perakitan->Bppb->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                foreach ($s->Perakitan->Karyawan as $i) {
                    array_push($arr, "<small>" . $i->nama . "</small>");
                }
                return implode("<br>", $arr);
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                $id = $s->id;
                $p = AnalisaPsPerakitan::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();
                if ($s->status == 'rej_pemeriksaan_terbuka') {
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn = '<a href="/perakitan/analisa_ps/create/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                        <div><small> Permohonan Analisa Pemeriksaan Terbuka</small></div></a>
                        <div><small class="danger-text">Pemeriksaan Terbuka Ditolak</small></div>';
                        if ($p) {
                            $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                        }
                    }
                } else if ($s->status == 'rej_pemeriksaan_tertutup') {
                    if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn = '<a href="/perakitan/analisa_ps/create/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                        <div><small> Permohonan Analisa Pemeriksaan Tertutup</small></div></a>
                        <div><small class="danger-text">Pemeriksaan Tertutup</small></div>';
                        if ($p) {
                            $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                        }
                    }
                } else if ($s->status = 'analisa_pemeriksaan_terbuka_ps') {
                    if ($p) {
                        $btn = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $p->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                        <div><small> Lihat Analisa</small></div></a>
                        <div><small class="success-text">Analisa Pemeriksaan Terbuka Selesai</small></div>';
                    }
                } else if ($s->status = 'analisa_pemeriksaan_tertutup_ps') {
                    if ($p) {
                        $btn = '
                        <a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $p->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                        <div><small> Lihat Analisa</small></div></a>
                        <div><small class="success-text">Analisa Pemeriksaan Tertutup Selesai</small></div>';
                    }
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Klik untuk melihat detail BPPB">';
                $btn .= '<i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                $btn .= '<a class="dropdown-item" href="/bppb/edit/' . $s->id . '"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>';
                $btn .= '<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/bppb/delete/' . $s->id . '"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a></div>';
                return $btn;
            })
            ->rawColumns(['operator', 'produk', 'status', 'aksi', 'no_seri'])
            ->make(true);
    }

    public function perakitan_analisa_ps_show($id)
    {
        $s = AnalisaPsPerakitan::find($id);
        return view('page.engineering.analisa_ps_perakitan_show', ['id' => $id, 's' => $s]);
    }
    public function perakitan_analisa_ps_create($id)
    {
        $s = HasilPerakitan::find($id);
        $bppbid = $s->Perakitan->Bppb->id;
        $bom = DetailPermintaanBahanBaku::join('permintaan_bahan_bakus', 'detail_permintaan_bahan_bakus.permintaan_bahan_baku_id', '=', 'permintaan_bahan_bakus.id')
            ->where([
                ['permintaan_bahan_bakus.bppb_id', '=', $bppbid],
                ['permintaan_bahan_bakus.status', '=', 'acc_permintaan']
            ])
            ->groupby('detail_permintaan_bahan_bakus.bill_of_material_id')
            ->selectRaw("distinct(detail_permintaan_bahan_bakus.bill_of_material_id) as bill_of_material_id, sum(detail_permintaan_bahan_bakus.jumlah_diterima) as jumlah_diterima")
            ->get();

        return view('page.engineering.analisa_ps_perakitan_create', ['id' => $id, 's' => $s, 'bom' => $bom]);
    }

    public function perakitan_analisa_ps_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'analisa' => 'required',
                'realisasi_pengerjaan' => 'required',
                'tindak_lanjut' => 'required',
            ],
            [
                'realisasi_pengerjaan.required' => "Realisasi Pengejaan harus diisi",
                'analisa.required' => "Analisa harus diisi",
                'tindak_lanjut.required' => "Tindak Lanjut harus diisi",
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            $s = AnalisaPsPerakitan::create([
                'hasil_perakitan_id' => $id,
                'analisa' => $request->analisa,
                'realisasi_pengerjaan' => $request->realisasi_pengerjaan,
                'tindak_lanjut' => $request->tindak_lanjut
            ]);
            if ($s) {
                if (!empty($request->part)) {
                    $app = AnalisaPsPerakitan::find($s->id);
                    $app->BillOfMaterial()->sync($request->part, false);
                    $u = $app->save();
                    if ($u) {
                        $bool = true;
                    } else {
                        $bool = false;
                    }
                } else {
                    $bool = true;
                }

                if ($bool == true) {
                    $h = HasilPerakitan::find($id);
                    if ($h->status == "rej_pemeriksaan_terbuka") {
                        if ($h->tindak_lanjut_terbuka == "produk_spesialis") {
                            $h->status = "analisa_pemeriksaan_terbuka_ps";
                            $h->save();

                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $id,
                                "kegiatan" => 'analisa_pemeriksaan_terbuka_ps',
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => $request->tindak_lanjut
                            ]);

                            if ($c) {
                            }
                        }
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambah Analisa");
            }
        }
    }

    public function pengujian()
    {
        return view('page.engineering.pengujian_show');
    }

    public function pengujian_show()
    {
        $id = Auth::user()->id;
        $s = HasilMonitoringProses::whereHas('MonitoringProses.Bppb.DetailProduk.Produk', function ($q) use ($id) {
            $q->where('ppic_id', $id);
        })->where('tindak_lanjut', '=', 'produk_spesialis')->orWhereIn('status', ['req_analisa_perbaikan'])->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_bppb', function ($s) {
                return $s->MonitoringProses->Bppb->no_bppb;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->MonitoringProses->Bppb->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->MonitoringProses->Bppb->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->MonitoringProses->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                return $s->MonitoringProses->Karyawan->nama;
            })
            ->addColumn('no_seri', function ($s) {
                return $s->HasilPerakitan->no_seri;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                $ids = $s->id;

                $p = PerbaikanProduksi::whereHas('HasilMonitoringProses', function ($q) use ($ids) {
                    $q->where('id', $ids);
                })->orderBy('updated_at', 'desc')->first();

                if ($s->status == 'req_analisa_perbaikan') {
                    if ($s->tindak_lanjut == "produk_spesialis") {
                        $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/pengujian"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                        <div><small> Permohonan Analisa</small></div></a>
                        <div><small class="danger-text">Pengujian Ditolak</small></div>';

                        if ($p) {
                            $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                        }
                    }
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Klik untuk melihat detail BPPB">';
                $btn .= '<i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';

                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                $btn .= '<a class="dropdown-item" href="/bppb/edit/' . $s->id . '"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>';
                $btn .= '<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/bppb/delete/' . $s->id . '"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a></div>';
                return $btn;
            })
            ->rawColumns(['operator', 'produk', 'status', 'aksi'])
            ->make(true);
    }

    public function pengemasan()
    {
        return view('page.engineering.pengemasan_show');
    }

    public function pengemasan_show()
    {
        $id = Auth::user()->id;
        $s = HasilPengemasan::whereHas('Pengemasan.Bppb.DetailProduk.Produk', function ($q) use ($id) {
            $q->where('ppic_id', $id);
        })->where('tindak_lanjut', '=', 'produk_spesialis')->orWhereIn('status', ['req_analisa_perbaikan'])->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_bppb', function ($s) {
                return $s->Pengemasan->Bppb->no_bppb;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->Pengemasan->Bppb->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->Perakitan->Bppb->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                return $s->Pengemasan->Karyawan->nama;
            })
            ->addColumn('no_seri', function ($s) {
                return $s->HasilPerakitan->no_seri;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                $ids = $s->id;
                $p = PerbaikanProduksi::whereHas('HasilPengemasan', function ($q) use ($ids) {
                    $q->where('id', $ids);
                })->orderBy('updated_at', 'desc')->first();

                if ($s->status == 'req_analisa_perbaikan') {
                    if ($s->tindak_lanjut == "produk_spesialis") {
                        $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/pengujian"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                        <div><small> Permohonan Analisa</small></div></a>
                        <div><small class="danger-text">Pengujian Ditolak</small></div>';

                        if ($p) {
                            $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                        }
                    }
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Klik untuk melihat detail BPPB">';
                $btn .= '<i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';

                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                $btn .= '<a class="dropdown-item" href="/bppb/edit/' . $s->id . '"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>';
                $btn .= '<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/bppb/delete/' . $s->id . '"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a></div>';
                return $btn;
            })
            ->rawColumns(['operator', 'produk', 'status', 'aksi'])
            ->make(true);
    }
}
