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
        $hp1 = HasilPerakitan::whereHas('Perakitan.Bppb.DetailProduk.Produk', function ($q) use ($id) {
            $q->where('ppic_id', $id);
        })->where('tindak_lanjut_terbuka', '=', 'produk_spesialis')->orWhereIn('status', ['analisa_pemeriksaan_terbuka_ps', 'analisa_pemeriksaan_tertutup_ps'])->get();

        $hp2 = HasilPerakitan::whereHas('Perakitan.Bppb.DetailProduk.Produk', function ($q) use ($id) {
            $q->where('ppic_id', $id);
        })->where('tindak_lanjut_tertutup', '=', 'produk_spesialis')->orWhereIn('status', ['analisa_pemeriksaan_terbuka_ps', 'analisa_pemeriksaan_tertutup_ps'])->get();

        $hp = $hp1->merge($hp2);

        return DataTables::of($hp)
            ->addIndexColumn()
            ->addColumn('no_bppb', function ($s) {
                return $s->Perakitan->Bppb->no_bppb;
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
                $p = PerbaikanProduksi::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();
                if ($s->status == 'rej_pemeriksaan_terbuka') {
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/perakitan"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                        <div><small> Permohonan Analisa Pemeriksaan Terbuka</small></div></a>
                        <div><small class="danger-text">Pemeriksaan Terbuka Ditolak</small></div>';
                        if ($p) {
                            $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                        }
                    }
                } else if ($s->status == 'rej_pemeriksaan_tertutup') {
                    if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/perakitan"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                        <div><small> Permohonan Analisa Pemeriksaan Tertutup</small></div></a>
                        <div><small class="danger-text">Pemeriksaan Tertutup</small></div>';
                        if ($p) {
                            $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                        }
                    }
                } else if ($s->status = 'analisa_pemeriksaan_terbuka_ps') {
                    if ($p) {
                        $btn = '<div><small class="success-text">Analisa Pemeriksaan Terbuka Selesai</small></div>
                        <a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                <button class="btn btn-sm btn-info"><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</button></a>';
                    }
                } else if ($s->status = 'analisa_pemeriksaan_tertutup_ps') {
                    if ($p) {
                        $btn = '<div><small class="success-text">Analisa Pemeriksaan Tertutup Selesai</small></div>
                        <a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                <button class="btn btn-sm btn-info"><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</button></a>';
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

    public function analisa_ps_perakitan_create($id)
    {
        $s = HasilPerakitan::find($id);
        $bppbid = $s->Perakitan->Bppb->id;
        $dp = $s->Perakitan->Bppb->detail_produk_id;


        $hp = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppbid) {
            $q->where('bppb_id', $bppbid);
        })->whereIn('status', ['rej_pemeriksaan_terbuka', 'rej_pemeriksaan_tertutup'])
            ->orWhereIn('tindak_lanjut_terbuka', ['perbaikan', 'produksi_spesialis'])
            ->orWhereIn('tindak_lanjut_tertutup', ['perbaikan', 'produksi_spesialis'])
            ->get();
        return view('page.eng.analisa_ps_perakitan_create', ['id' => $id, 's' => $s]);
    }

    public function analisa_ps_perakitan_store($id, Request $request)
    {
        // if($request->){
        // $s = AnalisaPsPerakitan::create([
        //     'hasil_perakitan_id' => $request->hasil_perakitan_id,
        //     'analisa' => $request->analisa,
        //     'realisasi_pengerjaan' => $request->realisasi_pengerjaan,
        //     'tindak_lanjut' => $request->tindak_lanjut
        // ]);
        // if ($s) {
        //     if (!empty($request->bill_of_material_id)) {
        //         $app = AnalisaPsPerakitan::find($s->id);
        //         $app->BillOfMaterial()->sync($request->bill_of_material_id, false);
        //         $app->save();
        //     } else if (empty($request->bill_of_material_id)) {
        //         return redirect()->back()->with('success', "Berhasil menambah Analisa");
        //     }
        // } else {
        //     return redirect()->back()->with('error', "Gagal menambah Analisa");
        // }}
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
