<?php

namespace App\Http\Controllers;

use App\AnalisaPsPengujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Imports\HasilPerakitanImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\HasilPerakitan;
use App\AnalisaPsPerakitan;
use App\BillOfMaterial;
use App\HasilMonitoringProses;
use App\PerbaikanProduksi;

class MtcController extends Controller
{
    //PRODUKSI
    public function perakitan()
    {
        return view('page.maintenance.perakitan_show');
    }

    public function perakitan_show()
    {
        $s = HasilPerakitan::whereHas('HistoriHasilPerakitan', function ($q) {
            $q->where([
                ['tindak_lanjut', '=', 'perbaikan'],
                ['kegiatan', '=', 'pemeriksaan_tertutup']
            ]);
        })->get();

        return DataTables::of($s)
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
                $p = PerbaikanProduksi::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();

                $a = AnalisaPsPerakitan::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();

                if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<small class="warning-text">Pemeriksaan Tertutup</small>';
                } else if ($s->status == 'acc_pemeriksaan_tertutup') {
                    $btn = '<small class="success-text">Pengujian</small>';
                } else if ($s->status == 'rej_pemeriksaan_tertutup') {
                    if ($s->tindak_lanjut_tertutup == "perbaikan") {
                        $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/perakitan"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Lakukan Perbaikan</small></div></a>
                                <div><small class="danger-text">Pemeriksaan Tertutup Not OK</small></div>';
                    } else if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn = '<small class="danger-text">Analisa Produk Spesialis</small>';
                    }
                } else if ($s->status == "perbaikan_pemeriksaan_tertutup") {
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                        <div><small>Lihat Hasil</small></div></a>
                        <div><small class="warning-text"><i class="fas fa-hourglass-half"></i> Pemeriksaan Tertutup</small></div>';
                    }
                } else if ($s->status == "analisa_pemeriksaan_tertutup_ps") {
                    if ($a) {
                        if ($a->tindak_lanjut == "karantina") {
                            $btn .= '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small> Lihat Analisa</small></div></a>';
                        } else if ($a->tindak_lanjut == "perbaikan") {
                            $btn .= '<a href="/perbaikan/produksi/create/' . $s->id . '/perakitan"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Lakukan Perbaikan</small></div></a>
                            <div><a href="#" class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"></div>
                            <small class="success-text"><i class="fas fa-search"></i> Lihat Hasil Analisa</small></a>';
                        }
                    }
                    // $btn .= '<div><small class="success-text">Pemeriksaan Terbuka PS</small></div>';
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/hasil/edit/' . $s->id . '">
                      <button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm m-1 deletenoserimodal" style="border-radius:50%;" data-toggle="modal" data-target="#deletenoserimodal" data-attr="{{route(\'perakitan.hasil.delete\', [\'id\' => ' . $s->id . '])}}"><i class="fas fa-trash"></i></button>
                  ';
                } else if ($s->status !== "req_pemeriksaan_terbuka") {
                    $btn = '<button type="button" class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-trash"></i></button>
                  ';
                }
                return $btn;
            })
            ->rawColumns(['operator', 'status', 'aksi', 'produk'])
            ->make(true);
    }

    public function pengujian()
    {
        return view('page.maintenance.pengujian_show');
    }

    public function pengujian_show()
    {
        $s = HasilMonitoringProses::whereHas('HistoriHasilPerakitan', function ($q) {
            $q->where([
                ['tindak_lanjut', '=', 'perbaikan'],
                ['kegiatan', '=', 'pemeriksaan_pengujian']
            ]);
        })->get();
        $btn = "";
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_seri', function ($s) {
                $btn = "";
            })
            ->editColumn('status', function ($s) {
                $a = AnalisaPsPengujian::all();
                $p = "";
                if ($s->status == "req_monitoring_proses") {
                } else if ($s->status == "rej_monitoring_proses") {
                    if ($s->tindak_lanjut == "perbaikan") {
                        $btn = "";
                        if ($a) {
                            $btn .= '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small> Lihat Analisa</small></div></a>';
                        }
                    } else if ($s->tindak_lanjut == "produk_spesialis") {
                        $btn = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                    }
                } else if ($s->status == "analisa_monitoring_proses") {
                    if ($a->tindak_lanjut == "perbaikan") {
                        $btn = "";
                        $btn .= '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Hasil Analisa</button>
                            <div><small> Lihat Analisa</small></div></a>';
                    } else if ($a->tindak_lanjut == "karantina") {
                        $btn = '<div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                    }
                } else if ($s->status == "perbaikan_monitoring_proses") {
                    $btn = "";
                } else if ($s->status == "pengemasan") {
                    $btn = "";
                }
            })
            ->rawColumns(['operator', 'status', 'aksi', 'produk'])
            ->make(true);
    }
}
