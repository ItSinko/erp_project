<?php

namespace App\Http\Controllers;

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
use App\HasilMonitoringProses;
use App\HasilPengemasan;

use App\AnalisaPsPerakitan;
use App\AnalisaPsPengujian;
use App\AnalisaPsPengemasan;

use App\BillOfMaterial;

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
        $s = HasilMonitoringProses::whereHas('HasilPerakitan.HistoriHasilPerakitan', function ($q) {
            $q->where([
                ['tindak_lanjut', '=', 'perbaikan'],
                ['kegiatan', '=', 'pemeriksaan_pengujian']
            ]);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_seri', function ($s) {
                $str = "";
                if ($s->no_barcode != NULL) {
                    $str = $s->MonitoringProses->alias_barcode . $s->no_barcode;
                } else {
                    $str = $s->HasilPerakitan->Perakitan->alias_tim . $s->HasilPerakitan->no_barcode;
                }
                return $str;
            })
            ->addColumn('no_bppb', function ($s) {
                return $s->MonitoringProses->Bppb->no_bppb;
            })
            ->addColumn('produk', function ($s) {
                $str = $s->MonitoringProses->Bppb->DetailProduk->nama;
                return $str;
            })
            ->addColumn('operator', function ($s) {
                return $s->MonitoringProses->Karyawan->nama;
            })
            ->addColumn('tanggal', function ($s) {
                return $s->MonitoringProses->tanggal;
            })
            ->editColumn('status', function ($s) {
                $hmp = $s->id;
                $a = AnalisaPsPengujian::where('hasil_monitoring_proses_id', '=', $s->id)
                    ->orderBy('updated_at', 'desc')
                    ->first();
                $p = PerbaikanProduksi::where('ketidaksesuaian_proses', '=', 'pengujian')
                    ->whereHas('HasilMonitoringProses', function ($q) use ($hmp) {
                        $q->where('hasil_monitoring_proses_id', $hmp);
                    })
                    ->orderBy('updated_at', 'desc')->first();
                $str = "";

                if ($s->status == "req_monitoring_proses") {
                    return '<div><small class="warning-text">Pengujian QC</small></div>';
                } else if ($s->status == "rej_monitoring_proses") {
                    if ($s->tindak_lanjut == "perbaikan") {
                        if ($a) {
                            $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small> Lihat Analisa</small></div></a>';
                        } else {
                            $str = '<a href="/perbaikan/produksi/create/' . $s->id . '/pengujian"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small> Lakukan Perbaikan</small></div></a>';
                        }
                    } else if ($s->tindak_lanjut == "produk_spesialis") {
                        $str = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                    }
                } else if ($s->status == "analisa_monitoring_proses") {
                    if ($a->tindak_lanjut == "perbaikan") {
                        $str = '<a href="/perbaikan/produksi/create/' . $s->id . '/pengujian"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Lakukan Perbaikan</small></div></a>';
                        $str .= '<div><a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Hasil Analisa</button></div>';
                    } else if ($a->tindak_lanjut == "karantina") {
                        $str = '<div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                    }
                } else if ($s->status == "perbaikan_monitoring_proses") {
                    $str = '<a href="/pengujian/monitoring_proses/hasil/status/' . $s->id . '/req_monitoring_proses"><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                    <div><small> Lapor Pengujian</small></div></a>';
                    $str .= '<div><a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '"><button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Hasil Perbaikan</button></a></div>';
                } else if ($s->status == "pengemasan") {
                    $str = '<div><i class="fas fa-check-circle" style="color:green;"></i></div>
                            <div><small>Pengemasan</small></div>';
                }
                return $str;
            })
            ->rawColumns(['operator', 'status', 'aksi', 'produk', 'no_seri'])
            ->make(true);
    }

    public function pengemasan()
    {
        return view('page.maintenance.pengemasan_show');
    }

    public function pengemasan_show()
    {
        $s = HasilPengemasan::whereHas('HasilPerakitan.HistoriHasilPerakitan', function ($q) {
            $q->where([
                ['tindak_lanjut', '=', 'perbaikan'],
                ['kegiatan', '=', 'pemeriksaan_pengemasan']
            ]);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_seri', function ($s) {
                $str = "";
                if ($s->no_barcode != "") {
                    $str = str_replace("/", "", $s->Pengemasan->alias_barcode) . $s->no_barcode;
                } else {
                    $str = str_replace("/", "", $s->HasilPerakitan->HasilMonitoringProses->first()->MonitoringProses->alias_barcode) . $s->HasilPerakitan->HasilMonitoringProses->first()->no_barcode;
                }
                return $str;
            })
            ->addColumn('no_bppb', function ($s) {
                return $s->Pengemasan->Bppb->no_bppb;
            })
            ->addColumn('produk', function ($s) {
                $str = $s->Pengemasan->Bppb->DetailProduk->nama;
                return $str;
            })
            ->addColumn('operator', function ($s) {
                return $s->Pengemasan->Karyawan->nama;
            })
            ->addColumn('tanggal', function ($s) {
                return $s->Pengemasan->tanggal;
            })
            ->editColumn('status', function ($s) {
                $hp = $s->id;
                $a = AnalisaPsPengemasan::where('hasil_pengemasan_id', '=', $s->id)
                    ->orderBy('updated_at', 'desc')
                    ->first();
                $p = PerbaikanProduksi::where('ketidaksesuaian_proses', '=', 'pengemasan')
                    ->whereHas('HasilPengemasan', function ($q) use ($hp) {
                        $q->where('id', $hp);
                    })
                    ->orderBy('updated_at', 'desc')->first();
                $str = "";

                if ($s->status == "req_pengemasan") {
                    return '<div><small class="warning-text">Pemeriksaan QC</small></div>';
                } else if ($s->status == "rej_pengemasan") {
                    if ($s->tindak_lanjut == "perbaikan") {
                            $str = '<a href="/perbaikan/produksi/create/' . $s->id . '/pengemasan"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button><div><small> Lakukan Perbaikan</small></div></a>';
                    } else if ($s->tindak_lanjut == "produk_spesialis") {
                        $str = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                    }
                } else if ($s->status == "analisa_pengemasan_ps") {
                    if ($a->tindak_lanjut == "perbaikan") {
                        $str = '<a href="/perbaikan/produksi/create/' . $s->id . '/pengujian"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button><div><small>Lakukan Perbaikan</small></div></a>';
                        $str .= '<div><a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Hasil Analisa</button></div>';
                    } else if ($a->tindak_lanjut == "karantina") {
                        $str = '<div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                    }
                } else if ($s->status == "perbaikan_pengemasan") {
                    $hmp = HasilMonitoringProses::where('hasil_perakitan_id', $s->hasil_perakitan_id)->first();
                    if($hmp->status == "pengemasan"){
                        if($p){
                            $str = '<a href="/pengemasan/hasil/status/' . $s->id . '/req_pengemasan"><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button><div><small> Lapor Pengujian</small></div></a>';
                            $str .= '<div><a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '"><button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Hasil Perbaikan</button></a></div>';
                        }
                    }
                    else if($hmp->status != "pengemasan")
                    {
                        $str .= "<div><small class='warning-text'>Masuk ke Pengujian</small></div>";
                    }
                } else if ($s->status == "ok") {
                    $str = '<div><i class="fas fa-check-circle" style="color:green;"></i></div><div><small>Penyerahan</small></div>';
                }
                return $str;
            })
            ->rawColumns(['operator', 'status', 'aksi', 'produk', 'no_seri'])
            ->make(true);

    }
}
