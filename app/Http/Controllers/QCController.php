<?php

namespace App\Http\Controllers;

use App\AcuanLkpLup;
use App\AnalisaPsPengujian;
use Illuminate\Http\Request;
use App\DetailProduk;
use App\Bppb;
use App\Produk;
use App\Karyawan;
use App\Perakitan;
use App\HasilPerakitan;
use App\HistoriHasilPerakitan;
use App\MonitoringProses;
use App\HasilMonitoringProses;
use App\PemeriksaanRakit;
use App\IkPemeriksaanPengujian;
use App\HasilIkPemeriksaanPengujian;
use App\PemeriksaanProsesPengujian;
use App\HasilPemeriksaanProsesPengujian;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserLogController;
use App\PerbaikanProduksi;
use App\HasilPengemasan;
use App\CekPengemasan;
use App\DetailIkPemeriksaan;
use App\FormatLkpLup;
use App\Kalibrasi;
use App\ListKalibrasi;
use App\PackingList;
use App\DetailPackingList;
use App\IkPemeriksaan;
use App\ListIkPemeriksaan;
use App\ParameterLkpLup;
use App\PemeriksaanProses;
use App\PeriksaBarangMasuk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class QCController extends Controller
{
    protected $NotifikasiController;
    protected $UserLogController;

    public function __construct(
        NotifikasiController $NotifikasiController,
        UserLogController $UserLogController
    ) {
        $this->NotifikasiController = $NotifikasiController;
        $this->UserLogController = $UserLogController;
    }

    public function kedatangan_packing_list()
    {
        $pl = PackingList::all();
        return view('page.qc.kedatangan_packing_list_show', ['pl' => $pl]);
    }

    public function kedatangan_packing_list_detail($id)
    {
        $pl = PackingList::where('id', $id)->with('PoPembelian')->with('PoPembelian.Supplier')->first();
        return $pl;
    }

    public function kedatangan_packing_list_show($id)
    {
        $s = DetailPackingList::where('packing_list_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('kode_barang', function ($s) {
                return "-";
            })
            ->addColumn('nama_barang', function ($s) {
                return $s->nama_barang;
            })
            ->editColumn('jumlah', function ($s) {
                return $s->jumlah;
            })
            ->addColumn('status', function ($s) {
                if ($s->status == "dibuat") {
                    $btn = '<a href="/perakitan/pemeriksaan/bppb/' . $s->id . '">';
                    $btn .= '<div><button type="button" class="btn btn-primary btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></div>';
                    $btn .= '<div><small>Lihat Semua Data</small></div></a>';
                    return $btn;
                }
            })
            ->make(true);
    }

    public function kedatangan_analisa_sampling()
    {
        return view('page.qc.kedatangan_analisa_sampling_show');
    }

    public function kedatangan_analisa_sampling_show()
    {
        $a = "";
    }

    public function lkp_lup_show($produk)
    {
        $f = FormatLkpLup::where('produk_id', $produk)
            ->with('AcuanLkpLup', 'AcuanLkpLup.ParameterLkpLup')
            ->get();

        echo json_encode($f);
    }

    public function lkp_lup_create($id)
    {
        $p = Produk::find($id);
        return view('page.qc.lkp_lup_create', ['p' => $p, 'id' => $id]);
    }

    public function lkp_lup_store(Request $request, $id)
    {
        $bool = true;
        if ($request->nama_pengecekan != "") {
            for ($i = 0; $i < count($request->nama_pengecekan); $i++) {
                $f = FormatLkpLup::create([
                    'produk_id' => $id,
                    'nama_pengecekan' => $request->nama_pengecekan[$i]
                ]);

                if ($f) {
                    if ($request->nama_parameter[$i] != "") {
                        for ($j = 0; $j < count($request->nama_parameter[$i]); $j++) {
                            $a = AcuanLkpLup::create([
                                'format_lkp_lup_id' => $f->id,
                                'nama_parameter' => $request->nama_parameter[$i][$j]
                            ]);

                            if ($a) {
                                for ($k = 0; $k < count($request->nilai_parameter[$i][$j]); $k++) {
                                    if ($request->nilai_parameter[$i][$j][$k] != "") {
                                        $p = ParameterLkpLup::create([
                                            'acuan_lkp_lup_id' => $a->id,
                                            'nilai_parameter' => $request->nilai_parameter[$i][$j][$k]
                                        ]);
                                        if (!$p) {
                                            $bool = false;
                                        }
                                    }
                                }
                            } else {
                                $bool = false;
                            }
                        }
                    }
                } else {
                    $bool = false;
                }
            }
        } else {
            $bool = false;
        }

        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil mengubah status Pengujian");
        } else if ($bool == false) {
            return redirect()->back()->with('error', "Gagal mengubah status Pengujian");
        }
    }

    public function perakitan_pemeriksaan()
    {
        return view('page.qc.perakitan_pemeriksaan_show');
    }

    public function perakitan_pemeriksaan_show()
    {
        $p = Bppb::with('Perakitan')->get();
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
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/perakitan/pemeriksaan/laporan/show/' . $s->id . '" data-id="' . $s->id . '">';
                $btn .= '<div><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fa fa-search"></i></button></div>';
                $btn .= '<div><small>Detail Laporan</small></div></a>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href="/perakitan/pemeriksaan/bppb/' . $s->id . '">';
                $btn .= '<div><button type="button" class="btn btn-primary btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></div>';
                $btn .= '<div><small>Lihat Semua Data</small></div></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan', 'aksi'])
            ->make(true);
    }

    public function perakitan_pemeriksaan_bppb($id)
    {
        $s = Bppb::find($id);
        return view('page.qc.perakitan_pemeriksaan_bppb_show', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_bppb_show($id, $status)
    {
        if ($status == "semua") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', '=', $id);
            })->whereNotIn('status', ['dibuat'])->get();
        } else if ($status == "req_pemeriksaan_terbuka") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', '=', $id);
            })->whereIn('status', ['req_pemeriksaan_terbuka'])->get();
        } else if ($status == "req_pemeriksaan_tertutup") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', '=', $id);
            })->whereIn('status', ['req_pemeriksaan_tertutup'])->get();
        } else if ($status == "acc_pemeriksaan_tertutup") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', '=', $id);
            })->whereIn('status', ['acc_pemeriksaan_tertutup'])->get();
        }

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('checkbox', function ($s) {
                $btn = "";
                if ($s->status == 'req_pemeriksaan_terbuka' || $s->status == 'req_pemeriksaan_tertutup') {
                    $btn = '<input class="form-check-input ' . $s->status . '" type="checkbox" value="' . $s->id . '" id="checkbox" name="checkbox[]">';
                } else {
                    $btn = '<input class="form-check-input" type="checkbox" value="' . $s->id . '" id="checkbox" name="checkbox[]" disabled>';
                }
                return $btn;
            })
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->editColumn('no_seri', function ($s) {
                return $s->Perakitan->alias_tim .  $s->no_seri;
            })
            ->editColumn('kondisi_fisik_bahan_baku', function ($s) {
                $btn = "";
                if ($s->kondisi_fisik_bahan_baku == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_fisik_bahan_baku == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('kondisi_saat_proses_perakitan', function ($s) {
                $btn = "";
                if ($s->kondisi_saat_proses_perakitan == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_saat_proses_perakitan == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('hasil_terbuka', function ($s) {
                $btn = "";
                if ($s->hasil_terbuka != "") {
                    $btn = '<a href="#" class="btn pop" data-container="body" data-placement="bottom" data-html="true" data-title="Pemeriksaan Terbuka" data-toggle="popover" 
                    data-content="
                    <div class=&quot;form-horizontal&quot;>
                    <div class=&quot;row&quot;>
                    <div class=&quot;col-sm-10 col-form-label&quot;>Kondisi Fisik Bahan Baku</div>
                    <div class=&quot;col-sm-2 col-form-label&quot; style=&quot;text-align:right;&quot;>';

                    if ($s->kondisi_fisik_bahan_baku == "ok") {
                        $btn .= '<small><i class=&quot;fas fa-check-circle popiconsc&quot;></i></small>';
                    } else if ($s->kondisi_fisik_bahan_baku == "nok") {
                        $btn .= '<small><i class=&quot;fas fa-times-circle popiconer&quot;></i></small>';
                    }

                    $btn .= '</div>
                    </div>
                    
                    <div class=&quot;row&quot;>
                    <div class=&quot;col-sm-10 col-form-label&quot;>Kondisi Saat Perakitan</div>
                    <div class=&quot;col-sm-2 col-form-label&quot; style=&quot;text-align:right;&quot;>';

                    if ($s->kondisi_saat_proses_perakitan == "ok") {
                        $btn .= '<small><i class=&quot;fas fa-check-circle popiconsc&quot;></i></small>';
                    } else if ($s->kondisi_saat_proses_perakitan == "nok") {
                        $btn .= '<small><i class=&quot;fas fa-times-circle popiconer&quot;></i></small>';
                    }

                    $btn .= '</div>
                    </div>

                    <div class=&quot;row&quot;>
                    <div class=&quot;col-sm-10 col-form-label&quot;>Hasil</div>
                    <div class=&quot;col-sm-2 col-form-label&quot; style=&quot;text-align:right;&quot;>';

                    if ($s->hasil_terbuka == "ok") {
                        $btn .= '<small><i class=&quot;fas fa-check-circle popiconsc&quot;></i></small>';
                    } else if ($s->hasil_terbuka == "nok") {
                        $btn .= '<small><i class=&quot;fas fa-times-circle popiconer&quot;></i></small>';
                    }
                    $btn .= '</div>
                    </div>
                    </div>
                    
                    <div class=&quot;row&quot;>
                        <div class=&quot;col-lg-6&quot;>
                            <h6 class=&quot;card-subheading text-muted&quot;><small>Keterangan</small></h6>
                            <h6 class=&quot;card-heading&quot;>';
                    if ($s->keterangan_terbuka != "") {
                        $btn .= $s->keterangan_terbuka;
                    } else {
                        $btn .= '-';
                    }

                    $btn .= '</h6>
                        </div>
                    </div>"
                    ';

                    if ($s->hasil_terbuka == "ok") {
                        $btn .= '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                    } else if ($s->hasil_terbuka == "nok") {
                        $btn .= '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                    }

                    $btn .= '</a>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_terbuka', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_terbuka != "ok" && !empty($s->tindak_lanjut_terbuka)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><b>&nbsp;';
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_terbuka);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_terbuka . '</small></div>';
                }
                return $btn;
            })
            ->editColumn('kondisi_setelah_proses', function ($s) {
                $btn = "";
                if ($s->kondisi_setelah_proses == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_setelah_proses == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('hasil_tertutup', function ($s) {
                $btn = "";
                if ($s->hasil_tertutup != "") {
                    $btn = '<a href="#" class="btn pop" data-container="body" data-placement="bottom" data-html="true" data-title="Pemeriksaan Tertutup" data-toggle="popover" 
                    data-content="
                    <div class=&quot;form-horizontal&quot;>
                    <div class=&quot;row&quot;>
                    <div class=&quot;col-sm-10 col-form-label&quot;>Fungsi</div>
                    <div class=&quot;col-sm-2 col-form-label&quot; style=&quot;text-align:right;&quot;>';

                    if ($s->fungsi == "ok") {
                        $btn .= '<small><i class=&quot;fas fa-check-circle popiconsc&quot;></i></small>';
                    } else if ($s->fungsi == "nok") {
                        $btn .= '<small><i class=&quot;fas fa-times-circle popiconer&quot;></i></small>';
                    }

                    $btn .= '</div>
                    </div>

                    <div class=&quot;row&quot;>
                    <div class=&quot;col-sm-10 col-form-label&quot;>Kondisi Setelah Perakitan</div>
                    <div class=&quot;col-sm-2 col-form-label&quot; style=&quot;text-align:right;&quot;>';

                    if ($s->kondisi_setelah_proses == "ok") {
                        $btn .= '<small><i class=&quot;fas fa-check-circle popiconsc&quot;></i></small>';
                    } else if ($s->kondisi_setelah_proses == "nok") {
                        $btn .= '<small><i class=&quot;fas fa-times-circle popiconer&quot;></i></small>';
                    }

                    $btn .= '</div>
                    </div>

                    <div class=&quot;row&quot;>
                    <div class=&quot;col-sm-10 col-form-label&quot;>Hasil</div>
                    <div class=&quot;col-sm-2 col-form-label&quot; style=&quot;text-align:right;&quot;>';

                    if ($s->hasil_tertutup == "ok") {
                        $btn .= '<small><i class=&quot;fas fa-check-circle popiconsc&quot;></i></small>';
                    } else if ($s->hasil_tertutup == "nok") {
                        $btn .= '<small><i class=&quot;fas fa-times-circle popiconer&quot;></i></small>';
                    }
                    $btn .= '</div>
                    </div>
                    </div>
                    
                    <div class=&quot;row&quot;>
                        <div class=&quot;col-lg-6&quot;>
                            <h6 class=&quot;card-subheading text-muted&quot;><small>Keterangan</small></h6>
                            <h6 class=&quot;card-heading&quot;>';
                    if ($s->keterangan_tertutup != "") {
                        $btn .= $s->keterangan_tertutup;
                    } else {
                        $btn .= '-';
                    }

                    $btn .= '</h6>
                        </div>
                    </div>"
                    ';

                    if ($s->hasil_tertutup == "ok") {
                        $btn .= '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                    } else if ($s->hasil_tertutup == "nok") {
                        $btn .= '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                    }

                    $btn .= '</a>';
                }
                return $btn;
            })
            ->editColumn('fungsi', function ($s) {
                $btn = "";
                if ($s->fungsi == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->fungsi == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_tertutup', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_tertutup == "aging") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_tertutup != "aging" && !empty($s->tindak_lanjut_tertutup)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i>&nbsp;<b>';
                    if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_tertutup);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_tertutup . '</small></div>';
                }
                return $btn;
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                $c = 0;
                foreach ($s->Perakitan->Karyawan as $i) {
                    if ($c < 2) {
                        array_push($arr, "<small>" . $i->nama . "</small>");
                    } else {
                        break;
                    }
                    $c++;
                }
                return implode("<br>", $arr);
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $id = $s->id;
                $p = PerbaikanProduksi::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/pemeriksaan/terbuka/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Pemeriksaan Terbuka</small></div></a>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                } else if ($s->status == "acc_pemeriksaan_terbuka") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "rej_pemeriksaan_terbuka" || $s->status == "perbaikan_pemeriksaan_terbuka" || $s->status == "analisa_pemeriksaan_terbuka_ps") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                } else if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<a href="/perakitan/pemeriksaan/tertutup/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Pemeriksaan Tertutup</small></div></a>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                } else if ($s->status == "acc_pemeriksaan_tertutup") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                } else if ($s->status == "rej_pemeriksaan_tertutup" || $s->status == "perbaikan_pemeriksaan_tertutup" || $s->status == "analisa_pemeriksaan_tertutup_ps") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                }
                return $btn;
            })
            // ->editColumn('status', function ($s) {
            //     $btn = "";
            //     if ($s->status == "req_pemeriksaan_terbuka") {
            //         $btn = '<span class="info-text">Permintaan Pemeriksaan Terbuka</span>';
            //     } else if ($s->status == "acc_pemeriksaan_terbuka") {
            //         $btn = '<span class="warning-text">Menunggu Pemeriksaan Tertutup</span>';
            //     } else if ($s->status == "rej_pemeriksaan_terbuka") {
            //         $btn = '<span class="danger-text">Pemeriksaan Terbuka Not OK</span>';
            //     } else if ($s->status == "req_pemeriksaan_tertutup") {
            //         $btn = '<span class="info-text">Permintaan Pemeriksaan Tertutup</span>';
            //     } else if ($s->status == "acc_pemeriksaan_tertutup") {
            //         $btn = '<span class="warning-text">Selesai Pemeriksaan Perakitan</span>';
            //     } else if ($s->status == "rej_pemeriksaan_tertutup") {
            //         $btn = '<span class="danger-text">Pemeriksaan Terbuka Not OK</span>';
            //     }
            //     return $btn;
            // })
            ->rawColumns(['checkbox', 'operator', 'aksi', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'tindak_lanjut_terbuka', 'kondisi_setelah_proses', 'hasil_terbuka', 'hasil_tertutup', 'fungsi', 'tindak_lanjut_tertutup'])
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
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                foreach ($s->Karyawan as $i) {
                    array_push($arr, $i->nama);
                }
                return implode("<br>", $arr);
            })
            ->addColumn('jumlah', function ($s) {
                $btn = HasilPerakitan::where('perakitan_id', $s->id)->count();
                return $btn . " " . $s->Bppb->DetailProduk->satuan;
            })
            // ->addColumn('status', function ($s) {
            //     $btn = "";
            //     if ($s->status == '12') {
            //         $c = HasilPerakitan::where('perakitan_id', '=', $s->id)->whereIn('status', ['req_pemeriksaan_terbuka', 'req_pemeriksaan_tertutup'])->count();
            //         if ($c > 0) {
            //             $btn = '<span class="warning-text">
            //             Periksa
            //         </span>';
            //         } else if ($c <= 0) {
            //             $btn = '<div class="inline-flex">
            //             <a href = "/perakitan/laporan/status/' . $s->id . '/selesai">
            //                 <button type="button" class="btn btn-block btn-outline-success karyawan-img-small" style="border-radius:50%;" title="Kirim Laporan ke Produksi"><i class="fas fa-check"></i></button>
            //             </a>
            //             </div>';
            //         }
            //     }

            //     return $btn;
            // })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/perakitan/pemeriksaan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm karyawan-img-small" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['operator', 'aksi'])
            ->make(true);
    }

    public function perakitan_multiple_status($id, $status)
    {
        $bool = true;
        $arr = explode(",", $id);
        if ($status == "acc_pemeriksaan_terbuka") {
            foreach ($arr as $i) {
                $s = HasilPerakitan::find($i);
                $s->kondisi_fisik_bahan_baku = "ok";
                $s->kondisi_saat_proses_perakitan = "ok";
                $s->tindak_lanjut_terbuka = "ok";
                $s->keterangan = "";
                $s->hasil_terbuka = "ok";
                $s->status = "req_pemeriksaan_tertutup";
                $u = $s->save();

                if ($u) {
                    $c = HistoriHasilPerakitan::create([
                        'hasil_perakitan_id' => $i,
                        'kegiatan' => 'pemeriksaan_terbuka',
                        'tanggal' => Carbon::now()->toDateString(),
                        'hasil' => "ok",
                        'keterangan' => "",
                        'tindak_lanjut' => "ok"
                    ]);
                    if (!$c) {
                        $bool = false;
                    }
                } else {
                    $bool = false;
                }
            }
        } else if ($status == "acc_pemeriksaan_tertutup") {
            foreach ($arr as $i) {
                $s = HasilPerakitan::find($i);
                $s->fungsi = "ok";
                $s->kondisi_setelah_proses = "ok";
                $s->hasil_tertutup = "ok";
                $s->tindak_lanjut_tertutup = "ok";
                $s->keterangan_tindak_lanjut_tertutup = "ok";
                $s->status = $status;
                $u = $s->save();

                if ($u) {
                    $c = HistoriHasilPerakitan::create([
                        'hasil_perakitan_id' => $i,
                        'kegiatan' => 'pemeriksaan_tertutup',
                        'tanggal' => Carbon::now()->toDateString(),
                        'hasil' => "ok",
                        'keterangan' => "",
                        'tindak_lanjut' => "ok"
                    ]);
                    if (!$c) {
                        $bool = false;
                    }
                } else {
                    $bool = false;
                }
            }
        }

        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil mengubah Data");
        } else {
            return redirect()->back()->with('error', "Gagal mengubah Data");
        }
    }

    public function perakitan_pemeriksaan_terbuka_edit($id)
    {
        $s = HasilPerakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_terbuka_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_terbuka_update($id, Request $request)
    {
        $v = [];
        if ($request->hasil_terbuka == "ok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_terbuka' => 'required',
                ],
                [
                    'tindak_lanjut_terbuka.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->hasil_terbuka == "nok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_terbuka' => 'required',
                    'keterangan_tindak_lanjut_terbuka' => 'required',
                ],
                [
                    'tindak_lanjut_terbuka.required' => "Tindak Lanjut harus dipilih",
                    'keterangan_tindak_lanjut_terbuka.required' => "Keterangan harus diisi",
                ]
            );
        }
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $status = "";
            if ($request->hasil_terbuka == "ok") {
                $status = "req_pemeriksaan_tertutup";
            } else {
                $status = "rej_pemeriksaan_terbuka";
            }

            $h = HasilPerakitan::find($id);
            $h->kondisi_fisik_bahan_baku = $request->kondisi_fisik_bahan_baku;
            $h->kondisi_saat_proses_perakitan = $request->kondisi_saat_proses_perakitan;
            $h->tindak_lanjut_terbuka = $request->tindak_lanjut_terbuka;
            $h->hasil_terbuka = $request->hasil_terbuka;
            $h->keterangan_tindak_lanjut_terbuka = $request->keterangan_tindak_lanjut_terbuka;
            $h->status = $status;
            $u = $h->save();

            if ($u) {
                $c = HistoriHasilPerakitan::create([
                    'hasil_perakitan_id' => $id,
                    'kegiatan' => 'pemeriksaan_terbuka',
                    'tanggal' => Carbon::now()->toDateString(),
                    'hasil' => $request->hasil_terbuka,
                    'keterangan' => $request->keterangan_tindak_lanjut_terbuka,
                    'tindak_lanjut' => $request->tindak_lanjut_terbuka
                ]);
                if ($c) {
                    return redirect()->back()->with('success', "Berhasil mengubah Data");
                } else {
                    return redirect()->back()->with('error', "Gagal mengubah Data");
                }
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        }
    }

    public function perakitan_pemeriksaan_tertutup_edit($id)
    {
        $s = HasilPerakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_tertutup_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_tertutup_update($id, Request $request)
    {
        $v = [];
        if ($request->hasil_tertutup == "ok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_tertutup' => 'required',
                ],
                [
                    'tindak_lanjut_tertutup.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->hasil_tertutup == "nok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_tertutup' => 'required',
                    'keterangan_tindak_lanjut_tertutup' => 'required',
                ],
                [
                    'tindak_lanjut_tertutup.required' => "Tindak Lanjut harus dipilih",
                    'keterangan_tindak_lanjut_tertutup.required' => "Keterangan harus diisi",
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $status = "";
            if ($request->hasil_tertutup == "ok") {
                $status = "acc_pemeriksaan_tertutup";
            } else {
                $status = "rej_pemeriksaan_tertutup";
            }

            $h = HasilPerakitan::find($id);
            $h->fungsi = $request->fungsi;
            $h->kondisi_setelah_proses = $request->kondisi_setelah_proses;
            $h->hasil_tertutup = $request->hasil_tertutup;
            $h->tindak_lanjut_tertutup = $request->tindak_lanjut_tertutup;
            $h->keterangan_tindak_lanjut_tertutup = $request->keterangan_tindak_lanjut_tertutup;
            $h->status = $status;
            $u = $h->save();

            if ($u) {
                $c = HistoriHasilPerakitan::create([
                    'hasil_perakitan_id' => $id,
                    'kegiatan' => 'pemeriksaan_tertutup',
                    'tanggal' => Carbon::now()->toDateString(),
                    'hasil' => $request->hasil_tertutup,
                    'keterangan' => $request->keterangan_tindak_lanjut_tertutup,
                    'tindak_lanjut' => $request->tindak_lanjut_tertutup
                ]);
                if ($c) {
                    return redirect()->back()->with('success', "Berhasil mengubah Data");
                } else {
                    return redirect()->back()->with('error', "Gagal mengubah Data");
                }
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        }
    }

    public function perakitan_pemeriksaan_laporan_edit($id)
    {
        $s = Perakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_laporan_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_laporan_update($id, Request $request)
    {
        $bool = true;
        for ($i = 0; $i < count($request->id); $i++) {
            $status = "";
            if ($request->kondisi_terbuka[$i] == "ok") {
                $status = "acc_pemeriksaan_terbuka";
            } else if ($request->kondisi_terbuka[$i] == "nok") {
                $status = "rej_pemeriksaan_terbuka";
            }
            $h = HasilPerakitan::find($request->id[$i]);
            $h->kondisi_terbuka = $request->kondisi_terbuka[$i];
            $h->tindak_lanjut_terbuka = $request->tindak_lanjut_terbuka[$i];
            $h->status = $status;
            $u = $h->save();


            HistoriHasilPerakitan::create([
                'hasil_perakitan_id' => $request->id[$i],
                'kegiatan' => 'pemeriksaan_terbuka',
                'tanggal' => Carbon::now()->toDateString(),
                'hasil' => $request->kondisi_terbuka[$i],
                'keterangan' => $request->keterangan[$i],
                'tindak_lanjut' => $request->tindak_lanjut_terbuka[$i]
            ]);
            if (!$u) {
                $bool = false;
            }
        }

        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil mengubah Data");
        } else if ($bool == false) {
            return redirect()->back()->with('error', "Gagal mengubah Data");
        }
    }

    public function perakitan_pemeriksaan_hasil($id)
    {
        $s = Perakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_hasil_show', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_hasil_show($id)
    {
        $s = HasilPerakitan::where('perakitan_id', '=', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->editColumn('kondisi_fisik_bahan_baku', function ($s) {
                $btn = "";
                if ($s->kondisi_fisik_bahan_baku == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_fisik_bahan_baku == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('kondisi_saat_proses_perakitan', function ($s) {
                $btn = "";
                if ($s->kondisi_saat_proses_perakitan == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_saat_proses_perakitan == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('hasil_terbuka', function ($s) {
                $btn = "";
                if ($s->hasil_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil_terbuka == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_terbuka', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_terbuka != "ok" && !empty($s->tindak_lanjut_terbuka)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><b>&nbsp;';
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_terbuka);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_terbuka . '</small></div>';
                }
                return $btn;
            })
            ->editColumn('kondisi_setelah_proses', function ($s) {
                $btn = "";
                if ($s->kondisi_setelah_proses == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_setelah_proses == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('hasil_tertutup', function ($s) {
                $btn = "";
                if ($s->hasil_tertutup == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil_tertutup == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('fungsi', function ($s) {
                $btn = "";
                if ($s->fungsi == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->fungsi == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_tertutup', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_tertutup == "aging") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_tertutup != "aging" && !empty($s->tindak_lanjut_tertutup)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i>&nbsp;<b>';
                    if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_tertutup);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_tertutup . '</small></div>';
                }
                return $btn;
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                foreach ($s->Perakitan->Karyawan as $i) {
                    array_push($arr, "<small>" . $i->nama . "</small>");
                }
                return implode("<br>", $arr);
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $id = $s->id;
                $p = PerbaikanProduksi::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/pemeriksaan/terbuka/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Pemeriksaan Terbuka</small></div></a>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                    <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                } else if ($s->status == "acc_pemeriksaan_terbuka") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "rej_pemeriksaan_terbuka" || $s->status == "perbaikan_pemeriksaan_terbuka" || $s->status == "analisa_pemeriksaan_terbuka_ps") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                } else if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<a href="/perakitan/pemeriksaan/tertutup/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Pemeriksaan Tertutup</small></div></a>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                } else if ($s->status == "acc_pemeriksaan_tertutup") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                } else if ($s->status == "rej_pemeriksaan_tertutup" || $s->status == "perbaikan_pemeriksaan_tertutup" || $s->status == "analisa_pemeriksaan_tertutup_ps") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-info"><small><i class="fas fa-cog"></i>&nbsp;Hasil Perbaikan</small></button></a>';
                    }
                }
                return $btn;
            })
            // ->editColumn('status', function ($s) {
            //     $btn = "";
            //     if ($s->status == "req_pemeriksaan_terbuka") {
            //         $btn = '<span class="info-text">Permintaan Pemeriksaan Terbuka</span>';
            //     } else if ($s->status == "acc_pemeriksaan_terbuka") {
            //         $btn = '<span class="warning-text">Menunggu Pemeriksaan Tertutup</span>';
            //     } else if ($s->status == "rej_pemeriksaan_terbuka") {
            //         $btn = '<span class="danger-text">Pemeriksaan Terbuka Not OK</span>';
            //     } else if ($s->status == "req_pemeriksaan_tertutup") {
            //         $btn = '<span class="info-text">Permintaan Pemeriksaan Tertutup</span>';
            //     } else if ($s->status == "acc_pemeriksaan_tertutup") {
            //         $btn = '<span class="warning-text">Selesai Pemeriksaan Perakitan</span>';
            //     } else if ($s->status == "rej_pemeriksaan_tertutup") {
            //         $btn = '<span class="danger-text">Pemeriksaan Terbuka Not OK</span>';
            //     }
            //     return $btn;
            // })
            ->rawColumns(['operator', 'aksi', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'tindak_lanjut_terbuka', 'kondisi_setelah_proses', 'hasil_terbuka', 'hasil_tertutup', 'fungsi', 'tindak_lanjut_tertutup'])
            ->make(true);
    }

    public function pemeriksaan_proses($bppb_id)
    {
        $b = Bppb::find($bppb_id);
        return view('page.qc.pemeriksaan_proses_show', ['bppb_id' => $bppb_id, 'b' => $b]);
    }

    public function pemeriksaan_proses_show($bppb_id, $proses)
    {
        $s = PemeriksaanProses::where([
            ['bppb_id', '=', $bppb_id],
            ['proses', '=', $proses]
        ])->get();
    }

    public function pengujian()
    {
        return view('page.qc.pengujian_show');
    }

    public function pdf_lkp($produk)
    {
        $pdf = PDF::loadView('page.qc.lkp.' . $produk)->setPaper('A4');
        return $pdf->stream('');
    }

    public function pengujian_show()
    {
        $s = "";
        if (Auth::user()->divisi->nama == "Quality Control") {
            $s = Bppb::with('Perakitan')->whereHas('Perakitan.HasilPerakitan', function ($q) {
                $q->whereIn('status', ['acc_pemeriksaan_tertutup']);
            })->get();
        } else if (Auth::user()->divisi->nama == "Laboratorium") {
            $s = Bppb::with('Perakitan')->whereHas('Perakitan.HasilPerakitan', function ($q) {
                $q->whereIn('status', ['acc_pemeriksaan_tertutup']);
            })->whereHas('DetailProduk.Produk', function ($q) {
                $q->where('kalibrasi', '=', 'ya');
            })->get();
        }
        return DataTables::of($s)
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
                $bppb_id = $s->id;
                $count = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
                    $q->where('bppb_id', $bppb_id);
                })->whereDoesntHave('HasilMonitoringProses', function ($q) {
                    $q->where('hasil', 'ok');
                })->whereIn('status', ['acc_pemeriksaan_tertutup'])->count();
                $btn = '<hgroup>
                        <h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6>
                        <div class="subheading "><small class="info-text">Pengujian: ' . $count . ' ' . $s->DetailProduk->satuan . '</small></div>
                        </hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat laporan"><i class="fas fa-ellipsis-h"></i></a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
                if ($s->DetailProduk->Produk->kalibrasi == "ya") {
                    $btn .= '<a class="dropdown-item" href="/kalibrasi/' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Kalibrasi</span></a>';
                } else if ($s->DetailProduk->Produk->kalibrasi == "tidak") {
                    $btn .= '<a class="dropdown-item" href="/pengujian/lkp_lup/' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;LUP dan LKP</span></a>';
                }
                $btn .= '<a class="dropdown-item monitoringprosesmodal" data-toggle="modal" data-target="#monitoringprosesmodal" data-attr="/pengujian/monitoring_proses/show/' . $s->id . '" data-id="' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Monitoring Proses</span></a>';
                $btn .= '<a class="dropdown-item" href="/pengujian/pemeriksaan_proses/hasil/' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Pemeriksaan Proses</span></a>';

                return $btn;
            })
            ->addColumn('data', function ($s) {
                return '<a href = "/pengujian/bppb/' . $s->id . '">
                <div><button class="btn btn-primary btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye" aria-hidden="true"></i></button></div>
                <div><small>Lihat Semua Data</small></div>
                </a>';
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat laporan"><i class="fas fa-plus-circle" aria-hidden="true"></i></a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">';
                if ($s->DetailProduk->Produk->kalibrasi == "ya") {
                    $btn .= '<a class="dropdown-item" href="/kalibrasi/create/' . $s->id . '"><span style="color: black;"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Kalibrasi</span></a>';
                }
                $btn .= '<a class="dropdown-item" href="/pengujian/monitoring_proses/create/' . $s->id . '"><span style="color: black;"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Monitoring Proses</span></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan', 'aksi', 'data'])
            ->make(true);
    }

    public function pengujian_bppb($id)
    {
        $s = Bppb::find($id);
        return view('page.qc.pengujian_bppb_show', ['id' => $id, 's' => $s]);
    }

    public function pengujian_bppb_show($id)
    {
        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->where('tindak_lanjut_tertutup', 'aging')
            ->orderBy('updated_at', 'desc')
            ->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($s) {
                $str = "";
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

                $str = '<input type="checkbox" class="hasil_perakitan_id" id="hasil_perakitan_id" name="hasil_perakitan_id[]" value="' . $s->id . '" ';
                if ($h) {
                    $str .= 'disabled';
                }
                $str .= '>';
                return $str;
            })
            ->addColumn('no_seri', function ($s) {
                $str = $s->Perakitan->alias_tim . $s->no_seri;
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($h) {
                    if ($h->no_barcode != NULL) {
                        $str .= ' / ' . str_replace('/', '', $h->MonitoringProses->alias_barcode) . $h->no_barcode;
                    }
                }
                return $str;
            })
            ->addColumn('operator_prd', function ($s) {
                $arr = [];
                foreach ($s->Perakitan->Karyawan as $i) {
                    array_push($arr, "<small>" . $i->nama . "</small>");
                }
                return implode("<br>", $arr);
            })
            ->addColumn('operator_qc', function ($s) {
                $str = "";
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($h) {
                    if ($h->MonitoringProses->karyawan_id != NULL) {
                        $str = $h->MonitoringProses->Karyawan->nama;
                    } else {
                        $str = '<div class="text-muted">Belum Ada</div>';
                    }
                } else {
                    $str = '<div class="text-muted">Belum Ada</div>';
                }
                return $str;
            })
            ->editColumn('hasil', function ($s) {
                $b = "";
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($h) {
                    if ($h->hasil == "ok") {
                        $b = '<i class="fas fa-check-circle" style="color:green;"></i>';
                    } else if ($h->hasil == "nok") {
                        $b = '<i class="fas fa-times-circle" style="color:red;"></i>';
                    }
                } else {
                    $b = '<div class="text-muted">Belum Ada</div>';
                }
                return $b;
            })
            ->editColumn('tindak_lanjut', function ($s) {
                $b = "";
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($h) {
                    if ($h->tindak_lanjut == 'pengemasan') {
                        $b .= '<i class="fas fa-check-circle" style="color:green;"></i><br>';
                    } else {
                        $b .= '<i class="fas fa-times-circle" style="color:red;"></i><br>';
                    }
                    $b .= "<small>" . ucfirst(str_replace("_", " ", $s->tindak_lanjut)) . "</small>";
                } else {
                    $b .= '<small class="text-muted">Belum ada</small>';
                }

                return $b;
            })
            ->addColumn('pemeriksaan', function ($s) {
                $btn = "";
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($h) {
                    if (count($h->HasilIkPemeriksaanPengujian) <=  0) {
                        if ($h->tindak_lanjut == "pengemasan") {
                            $btn .= '<i class="fas fa-check-circle" style="color:green;"></i>&nbsp;<small>Lolos</small>';
                        } else {
                            $btn .= '<i class="fas fa-times-circle" style="color:red;"></i>&nbsp;<small>Tidak Lolos</small>';
                        }
                    } else if (count($h->HasilIkPemeriksaanPengujian) > 0) {
                        $btn = "<small><ol>";
                        foreach ($h->HasilIkPemeriksaanPengujian as $i) {
                            $btn .= "<li>" . $i->standar_keberterimaan . "</li>";
                        }
                        $btn .= "</ol></small>";
                    }
                } else {
                    $btn .= '<div><small class="text-muted">Belum ada</small></div>';
                }
                return $btn;
            })
            ->editColumn('keterangan', function ($s) {
                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($h) {
                    if (empty($h->keterangan)) {
                        return '<small class="text-muted">Tidak Ada</small>';
                    } else {
                        return $h->keterangan;
                    }
                } else {
                    return '<small class="text-muted">Belum Ada</small>';
                }
            })
            ->addColumn('aksi', function ($s) {

                $h = HasilMonitoringProses::where('hasil_perakitan_id', $s->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                $p = "";
                $a = "";

                if ($h) {
                    $id = $h->id;
                    $p = PerbaikanProduksi::whereHas('HasilMonitoringProses', function ($q) use ($id) {
                        $q->where([
                            ['id', '=', $id]
                        ]);
                    })->orderBy('updated_at', 'desc')->first();

                    $a = AnalisaPsPengujian::whereHas('HasilMonitoringProses', function ($q) use ($id) {
                        $q->where('id', $id);
                    })->orderBy('updated_at', 'desc')->first();
                }

                $str = "";

                if ($h) {
                    if ($h->status == "req_monitoring_proses") {
                        $str = '<div><a href = "/pengujian/monitoring_proses/hasil/edit/' . $h->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                        <a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/pengujian/monitoring_proses/hasil/delete/' . $h->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a></div>';
                        if ($p) {
                            $str .= '<div><a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                            <button class="btn btn-sm btn-outline-info"><i class="fas fa-search"></i>&nbsp;Hasil Perbaikan</button></a></div>';
                        }
                    } else if ($h->status == "rej_monitoring_proses") {
                        if ($s->tindak_lanjut == 'perbaikan') {
                            $str = '<div><small class="danger-text">Perbaikan Produksi</small></div>';
                        } else if ($s->tindak_lanjut == 'produk_spesialis') {
                            $str = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                        }
                    } else if ($h->status == "req_perbaikan") {
                        $str = '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/pengujian/monitoring_proses/hasil/delete/' . $h->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                    } else if ($h->status == "perbaikan_monitoring_proses") {
                        if ($p) {
                            $str .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '"><button type="button" class="btn btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                <div><small> Lihat Hasil Perbaikan</small></div></a>
                                <div><small class="info-text">Perbaikan Produksi</small></div>';
                        }
                    } else if ($h->status == "analisa_monitoring_proses") {
                        if ($a) {
                            if ($a->tindak_lanjut == "perbaikan") {
                                $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                                    <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                    <div><small>Lihat Hasil Analisa</small></div></a>
                                    <div><small class="warning-text">Sedang dalam Perbaikan</small></div>';
                            } else if ($a->tindak_lanjut == "karantina") {
                                $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                                    <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                    <div><small> Lihat Hasil Analisa</small></div></a>
                                    <div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                            }
                        }
                    } else if ($h->status == "pengemasan") {
                        $str = '<i class="fas fa-check-circle" style="color:green;"></i>';
                    }
                } else if (!$h) {
                    $str = '<div><small class="secondary-text">Belum Pengujian</small></div>';
                }
                return $str;
            })
            ->rawColumns(['checkbox', 'no_seri', 'operator_qc', 'operator_prd', 'aksi'])
            ->make(true);
    }

    public function pengujian_lkp_lup($bppb_id)
    {
        $b = Bppb::find($bppb_id);
        return view('page.qc.pengujian_lkp_lup_show', ['b' => $b]);
    }

    public function pengujian_lkp_lup_show($id, $status)
    {
        $s = "";
        if ($status == "all") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', $id);
            })->where('tindak_lanjut_tertutup', 'aging')
                ->orderBy('updated_at', 'desc')
                ->get();
        } else if ($status == "selesai") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', $id);
            })->whereHas('LkpLupPengujian')
                ->get();
        } else if ($status == "belum") {
            $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
                $q->where('bppb_id', $id);
            })->whereDoesntHave('LkpLupPengujian')->where('tindak_lanjut_tertutup', 'aging')
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('hasil_perakitan_id', function ($s) {
                return $s->Perakitan->alias_tim . $s->no_seri;
            })
            ->addColumn('barcode', function ($s) {

                if (!isset($s->LkpLupPengujian)) {
                    return "-";
                } else if (isset($s->LkpLupPengujian)) {
                    if (count($s->LkpLupPengujian) > 0) {
                        return $s->LkpLupPengujian->no_barcode;
                    } else {
                        return "-";
                    }
                }
            })
            ->addColumn('teknisi', function ($s) {

                if (!isset($s->LkpLupPengujian)) {
                    return "-";
                } else if (isset($s->LkpLupPengujian)) {
                    if (count($s->LkpLupPengujian) > 0) {
                        return $s->LkpLupPengujian->Karyawan->nama;
                    } else {
                        return "-";
                    }
                }
            })
            ->addColumn('tanggal_pengujian', function ($s) {
                if (isset($s->LkpLupPengujian)) {
                    if (count($s->LkpLupPengujian) > 0) {
                        return $s->LkpLupPengujian->tanggal_pengujian;
                    } else {
                        return "-";
                    }
                } else if (!isset($s->LkpLupPengujian->tanggal_pengujian)) {
                    return "-";
                }
            })
            ->addColumn('tanggal_expired', function ($s) {
                if (isset($s->LkpLupPengujian)) {
                    if (count($s->LkpLupPengujian) > 0) {
                        return $s->LkpLupPengujian->tanggal_expired;
                    } else {
                        return "-";
                    }
                } else if (!isset($s->LkpLupPengujian->tanggal_expired)) {
                    return "-";
                }
            })
            ->addColumn('status', function ($s) {
                if (isset($s->LkpLupPengujian)) {
                    if (count($s->LkpLupPengujian) > 0) {
                        if ($s->LkpLupPengujian->status == "req_lkp") {
                        } else if ($s->LkpLupPengujian->status == "acc_lkp") {
                        } else if ($s->LkpLupPengujian->status == "rej_lkp") {
                        }
                    } else {
                        return '<a href = "/pengujian/lkp_lup/create/' . $s->id . '"><button class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-plus"></i></button></a>';
                    }
                } else if (!isset($s->LkpLupPengujian->status)) {
                    return '<a href = "/pengujian/lkp_lup/create/' . $s->id . '"><button class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-plus"></i></button></a>';
                }
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function pengujian_lkp_lup_create($id)
    {
        $b = Bppb::whereHas('Perakitan.HasilPerakitan', function ($q) use ($id) {
            $q->where('id', $id);
        })->first();

        $prdid = $b->DetailProduk->Produk->id;

        $f = FormatLkpLup::where('produk_id', $prdid)->get();

        return view('page.qc.pengujian_lkp_lup_create', ['id' => $id, 'b' => $b, 'f' => $f]);
    }

    public function pengujian_lkp_lup_store(Request $request)
    {
    }

    public function pengujian_monitoring_proses()
    {
        return view('page.qc.pengujian_monitoring_proses_show');
    }

    public function pengujian_monitoring_proses_show($bppb_id)
    {
        $s = MonitoringProses::whereHas('Bppb', function ($q) use ($bppb_id) {
            $q->where('id', $bppb_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                if (empty($s->Karyawan)) {
                    return "<span class='text-muted'>tidak tersedia</span>";
                } else if (!empty($s->Karyawan)) {
                    return $s->Karyawan->nama;
                }
            })
            ->addColumn('jumlah', function ($s) {
                $countok = HasilMonitoringProses::where([
                    ['monitoring_proses_id', '=', $s->id],
                    ['hasil', '=', 'ok']
                ])->count();

                $countnok = HasilMonitoringProses::where([
                    ['monitoring_proses_id', '=', $s->id],
                    ['hasil', '=', 'nok']
                ])->count();
                $btn = '<div class="success-text"><small>Hasil Baik: </small><b>' . $countok . '</b></div><div class="danger-text"><small>Hasil Tidak Baik: </small><b>' . $countnok . '</b></div>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/pengujian/monitoring_proses/hasil/create/' . $s->id . '"><button class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-plus"></i></button></a>
                        <a href = "/pengujian/monitoring_proses/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                        <a href = "/pengujian/monitoring_proses/laporan/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['operator', 'jumlah', 'aksi', 'operator'])
            ->make(true);
    }

    public function pengujian_monitoring_proses_hasil($id)
    {
        $s = MonitoringProses::find($id);
        return view('page.qc.pengujian_monitoring_proses_hasil_show', ['id' => $id, 's' => $s]);
    }

    public function pengujian_monitoring_proses_hasil_show($id)
    {
        $s = HasilMonitoringProses::where('monitoring_proses_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_seri', function ($s) {
                return $s->HasilPerakitan->Perakitan->alias_tim . $s->HasilPerakitan->no_seri;
            })
            ->editColumn('no_barcode', function ($s) {
                $b = "";
                if ($s->no_barcode == "") {
                    $b = '<small class="text-muted">Tidak Tersedia</small>';
                } else {
                    $b = str_replace('/', '', $s->MonitoringProses->alias_barcode) . $s->no_barcode;
                }
                return $b;
            })
            ->editColumn('hasil', function ($s) {
                $b = "";
                if ($s->hasil == "ok") {
                    $b = '<i class="fas fa-check-circle" style="color:green;"></i>';
                } else if ($s->hasil == "nok") {
                    $b = '<i class="fas fa-times-circle" style="color:red;"></i>';
                }
                return $b;
            })
            ->editColumn('tindak_lanjut', function ($s) {
                $b = "";
                if ($s->tindak_lanjut == 'pengemasan') {
                    $b .= '<i class="fas fa-check-circle" style="color:green;"></i><br>';
                } else {
                    $b .= '<i class="fas fa-times-circle" style="color:red;"></i><br>';
                }
                $b .= "<small>" . ucfirst(str_replace("_", " ", $s->tindak_lanjut)) . "</small>";
                return $b;
            })
            ->addColumn('pemeriksaan', function ($s) {
                $btn = "";
                if (count($s->HasilIkPemeriksaanPengujian) <=  0) {
                    if ($s->tindak_lanjut == "pengemasan") {
                        $btn .= '<i class="fas fa-check-circle" style="color:green;"></i>&nbsp;<small>Lolos</small>';
                    } else {
                        $btn .= '<i class="fas fa-times-circle" style="color:red;"></i>&nbsp;<small>Tidak Lolos</small>';
                    }
                } else if (count($s->HasilIkPemeriksaanPengujian) > 0) {
                    $btn = "<small><ol>";
                    foreach ($s->HasilIkPemeriksaanPengujian as $i) {
                        $btn .= "<li>" . $i->standar_keberterimaan . "</li>";
                    }
                    $btn .= "</ol></small>";
                }
                return $btn;
            })
            ->editColumn('keterangan', function ($s) {
                if (empty($s->keterangan)) {
                    return '<small class="text-muted">Tidak Ada</small>';
                } else {
                    return $s->keterangan;
                }
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $hasil_perakitan_id = $s->hasil_perakitan_id;
                $id = $s->id;
                $p = PerbaikanProduksi::whereHas('HasilMonitoringProses', function ($q) use ($id) {
                    $q->where([
                        ['id', '=', $id]
                    ]);
                })->orderBy('updated_at', 'desc')->first();

                $a = AnalisaPsPengujian::whereHas('HasilMonitoringProses', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();

                if ($s->status == "req_monitoring_proses") {
                    $btn = '<div><a href = "/pengujian/monitoring_proses/hasil/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                    <a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/pengujian/monitoring_proses/hasil/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a></div>';
                    if ($p) {
                        $btn .= '<div><a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-outline-info"><i class="fas fa-search"></i>&nbsp;Hasil Perbaikan</button></a></div>';
                    }
                } else if ($s->status == "rej_monitoring_proses") {
                    if ($s->tindak_lanjut == 'perbaikan') {
                        $btn = '<div><small class="danger-text">Perbaikan Produksi</small></div>';
                    } else if ($s->tindak_lanjut == 'produk_spesialis') {
                        $btn = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                    }
                } else if ($s->status == "req_perbaikan") {
                    $btn = '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/pengujian/monitoring_proses/hasil/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                } else if ($s->status == "perbaikan_monitoring_proses") {
                    if ($p) {
                        $btn .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '"><button type="button" class="btn btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small> Lihat Hasil Perbaikan</small></div></a>
                            <div><small class="info-text">Perbaikan Produksi</small></div>';
                    }
                } else if ($s->status == "analisa_monitoring_proses") {
                    if ($a) {
                        if ($a->tindak_lanjut == "perbaikan") {
                            $btn = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                                <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                <div><small>Lihat Hasil Analisa</small></div></a>
                                <div><small class="warning-text">Sedang dalam Perbaikan</small></div>';
                        } else if ($a->tindak_lanjut == "karantina") {
                            $btn = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                                <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                <div><small> Lihat Hasil Analisa</small></div></a>
                                <div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                        }
                    }
                } else if ($s->status == "pengemasan") {
                    $btn = $s->status;
                    $btn = '<i class="fas fa-check-circle" style="color:green;"></i>';
                }
                return $btn;
            })
            ->rawColumns(['no_barcode', 'hasil', 'tindak_lanjut', 'pemeriksaan', 'aksi', 'keterangan'])
            ->make(true);
    }

    public function pengujian_monitoring_proses_create($bppb_id, $arr)
    {
        $b = Bppb::find($bppb_id);
        $larr = explode(",", $arr);

        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->whereIn('id', $larr)->get();

        $k = Karyawan::whereNotIn('jabatan', ['direktur', 'manager'])->get();
        $p = IkPemeriksaanPengujian::where('detail_produk_id', '=', $b->detail_produk_id)->get();

        $hmp = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->whereNotNull('no_barcode')->count();

        $hp =  HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->whereNotNull('no_barcode')->count();

        $c = $hmp + $hp;
        return view('page.qc.pengujian_monitoring_proses_create', ['bppb_id' => $bppb_id, 'kry' => $k, 's' => $s, 'b' => $b, 'p' => $p, 'c' => $c]);
    }

    public function pengujian_monitoring_proses_store(Request $request, $bppb_id)
    {
        $v = [];
        if ($request->brc == "tidak") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri.*' => 'required',
                    'tindak_lanjut.*' => 'required',
                    'hasil' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.*.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.*.required' => "Tindak Lanjut harus dipilih",
                    'hasil.required' => "Hasil harus dipilih",
                ]
            );
        } else if ($request->brc == "ya") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut.*' => 'required',
                    'no_barcode.*' => 'required',
                    'hasil' => 'required',
                    'inisial_produk' => 'required',
                    'tipe_produk' => 'required',
                    'waktu_produksi' => 'required',
                    'urutan_bb' => 'required'
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.*.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.*.required' => "Tindak Lanjut harus dipilih",
                    'no_barcode.*.required' => "No Barcode harus diisi",
                    'hasil.required' => "Hasil harus dipilih",
                    'inisial_produk.required' => 'Barcode harus diisi',
                    'tipe_produk.required' => 'Barcode harus diisi',
                    'waktu_produksi.required' => 'Barcode harus diisi',
                    'urutan_bb.required' => 'Barcode harus diisi'
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $alias_barcode = "";
            if ($request->brc == "ya") {
                $alias_barcode = $request->inisial_produk . "/" . $request->tipe_produk . "/" . $request->waktu_produksi . "/" . $request->urutan_bb;
            }
            $c = MonitoringProses::create([
                'bppb_id' => $bppb_id,
                'tanggal' => $request->tanggal_laporan,
                'karyawan_id' => $request->karyawan_id,
                'alias_barcode' => $alias_barcode,
                'user_id' => Auth::user()->id
            ]);

            if ($c) {
                if (!empty($request->no_seri)) {
                    $bool = true;
                    for ($i = 0; $i < count($request->no_seri); $i++) {
                        $status = "";
                        if ($request->tindak_lanjut[$i] === "perbaikan" || $request->tindak_lanjut[$i] === "produk_spesialis") {
                            $status = 'rej_monitoring_proses';
                        } else if ($request->tindak_lanjut[$i] === "pengemasan") {
                            $status = 'pengemasan';
                        }

                        $no_barcode = "";
                        if (!empty($request->no_barcode[$i])) {
                            $no_barcode = $request->no_barcode[$i];
                        }

                        $cs = HasilMonitoringProses::create([
                            'monitoring_proses_id' => $c->id,
                            'hasil_perakitan_id' => $request->no_seri[$i],
                            'no_barcode' => $no_barcode,
                            'hasil' => $request->hasil[$i],
                            'keterangan' => $request->keterangan[$i],
                            'tindak_lanjut' => $request->tindak_lanjut[$i],
                            'status' => $status
                        ]);

                        if ($cs) {
                            $u = HasilMonitoringProses::find($cs->id);
                            $u->HasilIkPemeriksaanPengujian()->sync($request->pemeriksaan[$i]);
                            $up = $u->save();

                            $chhp = HistoriHasilPerakitan::create([
                                'hasil_perakitan_id' => $request->no_seri[$i],
                                'kegiatan' => 'pemeriksaan_pengujian',
                                'tanggal' => Carbon::now()->toDateString(),
                                'hasil' => $request->hasil[$i],
                                'keterangan' => $request->keterangan[$i],
                                'tindak_lanjut' => $request->tindak_lanjut[$i]
                            ]);

                            if (!$up) {
                                $bool = false;
                            }
                        }
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan Produk");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan Produk");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Produk");
            }
        }
    }

    public function pengujian_monitoring_proses_laporan_edit($id)
    {
        $s = MonitoringProses::find($id);
        $bppb_id = $s->bppb_id;
        $kry = Karyawan::whereNotIn('jabatan', ['direktur', 'manager', 'asisten manager'])->get();
        $p = IkPemeriksaanPengujian::where('detail_produk_id', '=', $s->Bppb->detail_produk_id)->get();
        $ns = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })
            ->whereIn('status', ['acc_pemeriksaan_tertutup'])
            ->DoesntHave('HasilMonitoringProses')
            ->orWhereHas('HasilMonitoringProses', function ($q) use ($id) {
                $q->where('monitoring_proses_id', $id);
            })->get();

        return view('page.qc.pengujian_monitoring_proses_laporan_edit', ['id' => $id, 's' => $s, 'kry' => $kry, 'ns' => $ns, 'p' => $p]);
    }

    public function pengujian_monitoring_proses_laporan_update($id, Request $request)
    {
        $v = [];
        if ($request->brc == "tidak") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.*.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->brc == "ya") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                    'no_barcode.*' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                    'no_barcode.*.required' => "No Barcode harus diisi",
                ]
            );
        }
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $s = MonitoringProses::find($id);
            $s->tanggal = $request->tanggal_laporan;
            $s->karyawan_id = $request->karyawan_id;
            $s->save();
            if ($s) {
                $hpid = array();
                if (!empty($request->hasil)) {
                    $bool = true;
                    $v = 0;
                    for ($i = 0; $i < count($request->hasil); $i++) {
                        echo ('id' . $request->mpid[$i]);
                        if (!empty($request->mpid[$i])) {
                            $hpid[$v] = $request->mpid[$i];
                            echo json_encode($hpid);
                            $u = HasilMonitoringProses::find($request->mpid[$i]);
                            $u->hasil_perakitan_id = $request->no_seri[$i];
                            $u->no_barcode = $request->no_barcode[$i];
                            $u->hasil = $request->hasil[$i];
                            $u->tindak_lanjut = $request->tindak_lanjut[$i];
                            $u->keterangan = $request->keterangan[$i];
                            $u->HasilIkPemeriksaanPengujian()->sync($request->pemeriksaan[$i]);
                            $us = $u->save();

                            if (!$us) {
                                $bool = false;
                            }
                        } else if (empty($request->id[$i])) {
                            $status = "";
                            if ($request->tindak_lanjut[$i] == 'pengemasan') {
                                $status = "pengemasan";
                            } else if ($request->tindak_lanjut[$i] == 'perbaikan') {
                                $status = "req_perbaikan";
                            } else if ($request->tindak_lanjut[$i] == 'produk_spesialis') {
                                $status = "req_analisa_perbaikan";
                            }
                            $cs  = HasilMonitoringProses::create([
                                'monitoring_proses_id' => $id,
                                'hasil_perakitan_id' => $request->no_seri[$i],
                                'no_barcode' => $request->no_barcode[$i],
                                'hasil' => $request->hasil[$i],
                                'keterangan' => $request->keterangan[$i],
                                'tindak_lanjut' => $request->tindak_lanjut[$i],
                                'status' => $status
                            ]);
                            if (!$cs) {
                                $bool = false;
                            } else if ($cs) {
                                $hpid[$v] = $cs->id;
                            }
                        }
                        $v++;
                    }
                    echo json_encode($hpid);
                    if (!empty($hpid)) {
                        HasilMonitoringProses::where('monitoring_proses_id', $id)->whereNotIn('id', $hpid)->delete();
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan Pengujian");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan Pengujian");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Pengujian");
            }
        }
    }

    public function pengujian_monitoring_proses_hasil_create($id)
    {
        $b = MonitoringProses::find($id);
        $bs = $b->bppb_id;
        $alias_barcode = explode('/', $b->alias_barcode);
        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bs) {
            $q->where('bppb_id', $bs);
        })->doesntHave('HasilMonitoringProses')
            ->whereIn('status', ['acc_pemeriksaan_tertutup'])->get();
        $p = IkPemeriksaanPengujian::where('detail_produk_id', '=', $b->Bppb->detail_produk_id)->get();
        return view('page.qc.pengujian_monitoring_proses_hasil_create', ['id' => $id, 's' => $s, 'b' => $b, 'p' => $p, 'alias_barcode' => $alias_barcode]);
    }

    public function pengujian_monitoring_proses_hasil_status($id, $status)
    {
        $s = HasilMonitoringProses::find($id);
        $s->status = $status;
        $u = $s->save();

        if ($u) {
            return redirect()->back()->with('success', "Berhasil mengubah status Pengujian");
        } else {
            return redirect()->back()->with('error', "Gagal mengubah status Pengujian");
        }
    }

    public function pengujian_monitoring_proses_hasil_store(Request $request, $id)
    {
        $v = [];
        if ($request->brc == "tidak") {
            $v = Validator::make(
                $request->all(),
                [
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                    'hasil' => 'required',
                ],
                [
                    'no_seri.*.required' => "No Seri harus diisi",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->brc == "ya") {
            $v = Validator::make(
                $request->all(),
                [
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                    'no_barcode.*' => 'required',
                ],
                [
                    'no_seri.*.required' => "No Seri harus diisi",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                    'no_barcode.*.required' => "No Barcode harus diisi",
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            if (!empty($request->no_seri)) {
                $bool = true;
                for ($i = 0; $i < count($request->no_seri); $i++) {

                    $cs = HasilMonitoringProses::create([
                        'monitoring_proses_id' => $id,
                        'hasil_perakitan_id' => $request->no_seri[$i],
                        'no_barcode' => $request->no_barcode[$i],
                        'hasil' => $request->hasil[$i],
                        'keterangan' => $request->keterangan[$i],
                        'tindak_lanjut' => $request->tindak_lanjut[$i]
                    ]);

                    if ($cs) {
                        $u = HasilMonitoringProses::find($cs->id);
                        $u->HasilIkPemeriksaanPengujian()->sync($request->pemeriksaan[$i]);
                        $up = $u->save();

                        $chhp = HistoriHasilPerakitan::create([
                            'hasil_perakitan_id' => $request->no_seri[$i],
                            'kegiatan' => 'pemeriksaan_pengujian',
                            'tanggal' => Carbon::now()->toDateString(),
                            'hasil' => $request->hasil[$i],
                            'keterangan' => $request->keterangan[$i],
                            'tindak_lanjut' => $request->tindak_lanjut[$i]
                        ]);

                        if (!$up) {
                            $bool = false;
                        }
                    }
                }
                if ($bool == true) {
                    return redirect()->back()->with('success', "Berhasil menambahkan Produk");
                } else if ($bool == false) {
                    return redirect()->back()->with('error', "Gagal menambahkan Produk");
                }
            }
        }
    }

    public function pengujian_monitoring_proses_hasil_edit($id)
    {
        $s = HasilMonitoringProses::find($id);
        $m = $s->MonitoringProses->Bppb->DetailProduk->id;
        // $p = HasilIkPemeriksaanPengujian::whereHas('IkPemeriksaanPengujian', function ($q) use ($m) {
        //     $q->where('detail_produk_id', $m);
        // })->get();

        $p = IkPemeriksaanPengujian::where('detail_produk_id', $m)->get();

        return view('page.qc.pengujian_monitoring_proses_hasil_edit', ['id' => $id, 's' => $s, 'p' => $p]);
    }

    public function pengujian_monitoring_proses_hasil_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tindak_lanjut' => 'required',
                'hasil' => 'required',
            ],
            [
                'hasil.required' => "Hasil harus dipilih",
                'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $u = HasilMonitoringProses::find($id);
            $u->HasilIkPemeriksaanPengujian()->sync($request->pemeriksaan);
            $u->tindak_lanjut = $request->tindak_lanjut;
            $u->hasil = $request->hasil;
            $u->keterangan = $request->keterangan;
            $u->no_barcode = $request->no_barcode;
            if ($request->tindak_lanjut == "produk_spesialis" || $request->tindak_lanjut == "perbaikan") {
                $u->status = 'rej_monitoring_proses';
            } else if ($request->tindak_lanjut == "pengemasan") {
                $u->status = 'pengemasan';
            }
            $u->save();

            if ($u) {
                $chhp = HistoriHasilPerakitan::create([
                    'hasil_perakitan_id' => $u->hasil_perakitan_id,
                    'kegiatan' => 'pemeriksaan_pengujian',
                    'tanggal' => Carbon::now()->toDateString(),
                    'hasil' => $request->hasil,
                    'keterangan' => $request->keterangan,
                    'tindak_lanjut' => $request->tindak_lanjut
                ]);
                if ($chhp) {
                    return redirect()->back()->with('success', "Berhasil mengubah Pemeriksaan");
                } else {
                    return redirect()->back()->with('error', "Gagal mengubah Pemeriksaan");
                }
            }
        }
    }

    public function pengujian_monitoring_proses_hasil_delete($id, Request $request)
    {
        $p = HasilMonitoringProses::where('id', $id)->first();
        $this->UserLogController->create(Auth::user()->id, "Hasil Monitoring Proses " . $p->HasilPerakitan->no_seri . ", untuk BPPB " . $p->MonitoringProses->Bppb->no_bppb, 'Hasil Monitoring Proses', 'Hapus', $request->keterangan_log);
        $hp = HasilMonitoringProses::find($id);
        $hp->delete();

        return redirect()->back();
    }

    public function pengujian_pemeriksaan_proses()
    {
        return view('page.qc.pengujian_pemeriksaan_proses_show');
    }

    public function pengujian_pemeriksaan_proses_show($id)
    {
        $s = PemeriksaanProsesPengujian::where('bppb_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('aksi', function ($s) use ($id) {
                $btn = '<a href = "/pengujian/pemeriksaan_proses/hasil/' . $id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/pengujian/pemeriksaan_proses/hasil/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/pengujian/pemeriksaan_proses/hasil/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pengujian_pemeriksaan_proses_hasil($id)
    {
        $s = Bppb::find($id);
        $p = IkPemeriksaanPengujian::where('detail_produk_id', $id)->get();

        return view('page.qc.pengujian_pemeriksaan_proses_hasil', ['id' => $id, 's' => $s, 'p' => $p]);
    }

    public function pengujian_pemeriksaan_proses_create($id)
    {
        $b = Bppb::find($id);
        $bppbid = $b->DetailProduk->id;
        $s = IkPemeriksaanPengujian::where('detail_produk_id', $bppbid)->get();

        return view('page.qc.pengujian_pemeriksaan_proses_create', ['id' => $id, 's' => $s, 'b' => $b]);
    }

    public function pengujian_pemeriksaan_proses_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'no_pemeriksaan' => 'required',
                'tanggal' => 'required',
                'jumlah_produksi' => 'required',
                'jumlah_sampling' => 'required',
            ],
            [
                'no_pemeriksaan.required' => "No Pemeriksaan harus diisi",
                'tanggal.required' => "Tanggal harus diisi",
                'jumlah_produksi.required' => "Jumlah Produksi harus diisi",
                'jumlah_sampling.required' => "Jumlah Sampling harus diisi",
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = PemeriksaanProsesPengujian::create([
                'bppb_id' => $id,
                'no_pemeriksaan' => $request->no_pemeriksaan,
                'tanggal' => $request->tanggal,
                'jumlah_produksi' => $request->jumlah_produksi,
                'jumlah_sampling' => $request->jumlah_sampling
            ]);
            if ($c) {
                if (!empty($request->hasil_ik_id)) {
                    $bool = true;
                    for ($j = 0; $j < count($request->hasil_ik_id); $j++) {
                        $cs = HasilPemeriksaanProsesPengujian::create([
                            'pemeriksaan_id' => $c->id,
                            'hasil_ik_id' => $request->hasil_ik_id[$j],
                            'hasil_ok' => $request->hasil_ok[$j],
                            'hasil_nok' => $request->hasil_nok[$j],
                            'karantina' => $request->karantina[$j],
                            'perbaikan' => $request->perbaikan[$j],
                            'keterangan' => $request->keterangan[$j]
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }

                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan Pemeriksaan Proses");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan Pemeriksaan Proses");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Pemeriksaan Proses");
            }
        }
    }

    public function pengujian_pemeriksaan_proses_not_ok()
    {
        return view('page.qc.pengujian_pemeriksaan_proses_not_ok_show');
    }

    public function pengujian_pemeriksaan_proses_not_ok_show($bppb_id, $ik_pengujian_id)
    {
        $s = HasilMonitoringProses::whereHas('HasilIkPemeriksaanPengujian', function ($q) use ($ik_pengujian_id) {
            $q->where('id', $ik_pengujian_id);
        })->whereHas('MonitoringProses', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('karyawan', function ($s) {
                return $s->MonitoringProses->Karyawan->nama;
            })
            ->addColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->MonitoringProses->tanggal)->format('d-m-Y');
            })
            ->addColumn('no_seri', function ($s) {
                return $s->HasilPerakitan->no_seri;
            })
            ->make(true);
    }

    public function pengujian_pemeriksaan_proses_edit($id)
    {
        return view('page.qc.pengujian_pemeriksaan_proses_edit', ['id' => $id]);
    }

    public function pengujian_pemeriksaan_proses_update($id, Request $request)
    {
        $bool = true;
        for ($j = 0; $j < count($request->hasil_ik_id); $j++) {
            $u = HasilPemeriksaanProsesPengujian::find($request->id[$j]);
            $u->hasil_ok = $request->hasil_ok[$j];
            $u->hasil_nok = $request->hasil_nok[$j];
            $u->karantina = $request->karantina[$j];
            $u->perbaikan = $request->perbaikan[$j];
            $u->keterangan = $request->keterangan[$j];
            $us = $u->save();

            if (!$us) {
                $bool = false;
            }
        }

        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil mengubah Pemeriksaan Proses");
        } else if ($bool == false) {
            return redirect()->back()->with('error', "Gagal mengubah Pemeriksaan Proses");
        }
    }

    public function ik_pemeriksaan()
    {
        $p = DetailProduk::all();
        return view('page.qc.ik_pemeriksaan', ['p' => $p]);
    }

    public function ik_pemeriksaan_show($id, $proses)
    {
        $ik = IkPemeriksaan::where([['detail_produk_id', '=', $id], ['proses', '=', $proses]])->with('ListIkPemeriksaan', 'ListIkPemeriksaan.DetailIkPemeriksaan')->get();
        return json_encode($ik);
    }

    public function ik_pemeriksaan_create($id, $proses)
    {
        $prd = DetailProduk::find($id);
        return view('page.qc.ik_pemeriksaan_create', ['id' => $id, 'proses' => $proses, 'prd' => $prd]);
    }

    public function ik_pemeriksaan_store(Request $request, $id, $proses)
    {
        $v = Validator::make(
            $request->all(),
            [
                'pemeriksaan.*' => 'required',
                'penerimaan.*' => 'required'
            ],
            [
                'pemeriksaan.*.required' => "aaaaaaaaaaPemeriksaan harus diisi",
                'penerimaan.*.required' => "Penerimaan harus diisi"
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = IkPemeriksaan::create([
                'detail_produk_id' => $id,
                'proses' => $proses,
                'keterangan' => $request->keterangan
            ]);
            $bool = true;
            if ($c) {
                for ($i = 0; $i < count($request->pemeriksaan); $i++) {
                    $cl = ListIkPemeriksaan::create([
                        'ik_pemeriksaan_id' => $c->id,
                        'pemeriksaan' => $request->pemeriksaan[$i]
                    ]);

                    if ($cl) {
                        for ($j = 0; $j < count($request->penerimaan[$i]); $j++) {
                            $cd = DetailIkPemeriksaan::create([
                                'list_ik_pemeriksaan_id' => $c->id,
                                'penerimaan' => $request->penerimaan[$i][$j]
                            ]);
                            if (!$cd) {
                                $bool = false;
                            }
                        }
                    } else {
                        $bool = false;
                    }
                }
            } else {
                $bool = false;
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan IK Pemeriksaan " . $proses);
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan IK Pemeriksaan " . $proses);
            }
        }
    }

    public function ik_pemeriksaan_edit($id)
    {
        $ik = IkPemeriksaan::find($id);
        return view('page.qc.ik_pemeriksaan_edit', ['ik' => $ik, 'id' => $id]);
    }

    public function ik_pemeriksaan_update(Request $request, $id)
    {
    }

    public function pengujian_ik_pemeriksaan()
    {
        return view('page.qc.pengujian_ik_pemeriksaan_show');
    }

    public function pengujian_ik_pemeriksaan_show()
    {
        $s = DetailProduk::has('IkPemeriksaanPengujian')->with('Produk')->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->foto . '"';
                }
                $gambar .= 'title="' . $s->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->nama . '</h6><div class="subheading text-muted">' . $s->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/pengujian/ik_pemeriksaan/detail/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/pengujian/ik_pemeriksaan/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/pengujian/ik_pemeriksaan/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'aksi'])
            ->make(true);
    }

    public function pengujian_ik_pemeriksaan_create()
    {
        $dp = DetailProduk::doesntHave('IkPemeriksaanPengujian')->get();
        return view('page.qc.pengujian_ik_pemeriksaan_create', ['dp' => $dp]);
    }

    public function pengujian_ik_pemeriksaan_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'detail_produk_id' => 'required',
                'hal_yang_diperiksa' => 'required',
                'standar_keberterimaan' => 'required'
            ],
            [
                'detail_produk_id.required' => "Produksi harus dipilih",
                'hal_yang_diperiksa.required' => "Hal yang diperiksa harus diisi",
                'standar_keberterimaan.required' => "Standar Keberterimaan harus diisi",
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            for ($i = 0; $i < count($request->hal_yang_diperiksa); $i++) {
                $c = IkPemeriksaanPengujian::create([
                    'detail_produk_id' => $request->detail_produk_id,
                    'hal_yang_diperiksa' => $request->hal_yang_diperiksa[$i]
                ]);

                if ($c) {
                    echo $c->id;
                    for ($j = 0; $j < count($request->standar_keberterimaan[$i]); $j++) {
                        $cs = HasilIkPemeriksaanPengujian::create([
                            'ik_pemeriksaan_id' => $c->id,
                            'standar_keberterimaan' => $request->standar_keberterimaan[$i][$j]
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }
                } else if (!$c) {
                    $bool = false;
                }
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Pengujian");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan Pengujian");
            }
        }
    }

    public function pengujian_ik_pemeriksaan_detail($id)
    {
        $s = IkPemeriksaanPengujian::where('detail_produk_id', $id)->get();
        $sp = DetailProduk::find($id);
        return view('page.qc.pengujian_ik_pemeriksaan_detail_show', ['id' => $id, 's' => $s, 'sp' => $sp]);
    }

    public function pengujian_ik_pemeriksaan_hasil_edit($id)
    {
        $s = IkPemeriksaanPengujian::find($id);
        return view('page.qc.pengujian_ik_pemersikaan_detail_edit', ['id' => $id, 's' => $s]);
    }

    public function pengujian_ik_pemeriksaan_hasil_create($id)
    {
        return view('page.qc.pengujian_ik_pemeriksaan', ['id' => $id]);
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

    public function kalibrasi($bppb_id)
    {
        $b = Bppb::find($bppb_id);
        $k = Kalibrasi::where('bppb_id', $bppb_id)->get();

        return view('page.qc.kalibrasi_show', ['bppb_id' => $bppb_id, 'b' => $b, 'k' => $k]);
    }

    public function kalibrasi_show($bppb_id, $id)
    {
        $s = "";
        if ($id == "0") {
            $s = ListKalibrasi::whereHas('Kalibrasi', function ($q) use ($bppb_id) {
                $q->where('bppb_id', $bppb_id);
            })->get();
        } else {
            $s = ListKalibrasi::where('kalibrasi_id', $id)->get();
        }
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('hasil_perakitan_id', function ($s) {
                return $s->HasilPerakitan->Perakitan->alias_tim . str_replace("/", "", $s->HasilPerakitan->no_seri);
            })
            ->addColumn('barcode', function ($s) {
                return str_replace("/", "", $s->Kalibrasi->alias_barcode) . $s->no_barcode;
            })
            ->editColumn('tanggal_kalibrasi', function ($s) {
                if (!empty($s->tanggal_kalibrasi)) {
                    return '<span>' . Carbon::createFromFormat('Y-m-d', $s->tanggal_kalibrasi)->format('d-m-Y') . '</span>';
                } else {
                    return '<span class="text-muted">-</span>';
                }
            })
            ->editColumn('tanggal_selesai', function ($s) {
                if (!empty($s->tanggal_selesai)) {
                    return '<span>' . Carbon::createFromFormat('Y-m-d', $s->tanggal_selesai)->format('d-m-Y') . '</span>';
                } else {
                    return '<span class="text-muted">-</span>';
                }
            })
            ->editColumn('hasil', function ($s) {
                if (!empty($s->hasil)) {
                    if ($s->hasil == "ok") {
                        return '<i class="fas fa-check-circle" style="color:green;"></i>';
                    } else {
                        return '<i class="fas fa-times-circle" style="color:red;"></i>';
                    }
                } else {
                    return '<span class="text-muted">-</span>';
                }
            })
            ->editColumn('tindak_lanjut', function ($s) {
                if (!empty($s->tindak_lanjut)) {
                    return '<span>' . $s->tindak_lanjut . '</span>';
                } else {
                    return '<span class="text-muted">-</span>';
                }
            })
            ->addColumn('aksi', function ($s) {
                if ($s->status == "req_kalibrasi") {
                    return '<small class="warning-text">Proses Uji Lab</small>';
                }
            })
            ->rawColumns(['tanggal_kalibrasi', 'tanggal_selesai', 'hasil', 'tindak_lanjut', 'aksi'])
            ->make(true);
    }

    public function kalibrasi_detail($id)
    {
        $k = Kalibrasi::find($id);
        return json_encode($k);
    }

    public function kalibrasi_create($bppb_id)
    {
        $s = Bppb::find($bppb_id);
        $k = Karyawan::whereNotIn('jabatan', ['direktur'])->get();

        $hp = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->where('tindak_lanjut_tertutup', 'aging')
            ->whereDoesntHave('ListKalibrasi')
            ->orderBy('updated_at', 'desc')
            ->get();

        $lki = ListKalibrasi::whereHas('Kalibrasi', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->max('no_barcode');

        $c = (int)$lki;

        // $hpg =  HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppb_id) {
        //     $q->where('bppb_id', $bppb_id);
        // })->whereNotNull('no_barcode')->count();

        // $c = $lki + $hpg;

        return view('page.qc.kalibrasi_create', ['s' => $s, 'k' => $k, 'hp' => $hp, 'c' => $c]);
    }

    public function kalibrasi_store(Request $request, $bppb_id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal_daftar' => 'required',
                'tanggal_permintaan_selesai' => 'required',
                'inisial_produk' => 'required',
                'tipe_produk' => 'required',
                'waktu_produksi' => 'required',
                'urutan_bb' => 'required',
                'no_barcode.*' => 'required'
            ],
            [
                'tanggal_daftar.required' => "Tanggal Pendaftaran harus diisi",
                'tanggal_permintaan_selesai.required' => "Tanggal Permintaan Selesai harus diisi",
                'inisial_produk.required' => 'Kode Barcode Harus diisi',
                'tipe_produk.required' => 'Kode Barcode Harus diisi',
                'waktu_produksi.required' => 'Kode Barcode Harus diisi',
                'urutan_bb.required' => 'Kode Barcode Harus diisi',
                'no_barcode.*.required' => "No Barcode Harus diisi"
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $ki = Kalibrasi::create([
                'bppb_id' => $bppb_id,
                'jenis_kalibrasi' => $request->jenis_kalibrasi,
                'tanggal_daftar' => $request->tanggal_daftar,
                'tanggal_permintaan_selesai' => $request->tanggal_permintaan_selesai,
                'alias_barcode' => $request->inisial_produk . "/" . $request->tipe_produk . "/" . $request->waktu_produksi . "/" . $request->urutan_bb,
                'pic_id' => Auth::user()->id
            ]);

            if ($ki) {
                $bool = true;
                for ($i = 0; $i < count($request->hasil_perakitan_id); $i++) {
                    $l = ListKalibrasi::create([
                        'kalibrasi_id' => $ki->id,
                        'hasil_perakitan_id' => $request->hasil_perakitan_id[$i],
                        'no_barcode' => $request->no_barcode[$i],
                        'status' => 'req_kalibrasi'
                    ]);

                    if (!$l) {
                        $bool = false;
                    }
                }

                if ($bool == true) {
                    return redirect()->back()->with('success', "Berhasil mengirimkan List No Seri");
                } else if ($bool == false) {
                    return redirect()->back()->with('error', "Gagal mengirimkan List No Seri");
                }
            }
        }
    }

    public function pengemasan()
    {
        return view('page.qc.pengemasan_show');
    }

    public function pengemasan_show()
    {
        $s = Bppb::with('MonitoringProses')->whereHas('MonitoringProses.HasilMonitoringProses', function ($q) {
            $q->whereIn('status', ['pengemasan']);
        })->get();

        return DataTables::of($s)
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
                $btn = '<hgroup><h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6><div class="subheading "><small class="success-text">Pengemasan: <b>' . $s->countRencanaPengemasan() . ' ' . $s->DetailProduk->satuan . '</b></small></div></hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a href="/pengemasan/bppb/show/qc/' . $s->id . '">
                            <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small>Lihat Laporan</small></div></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan'])
            ->make(true);
    }

    public function pengemasan_bppb_show($bppbid)
    {
        $s = Bppb::find($bppbid);
        $hp = HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppbid) {
            $q->where('bppb_id', $bppbid);
        })->has('HasilPerakitan.HasilMonitoringProses')->get();
        $c = CekPengemasan::where('detail_produk_id', $s->DetailProduk->id)->get();
        return view('page.qc.pengemasan_bppb_show', ['bppbid' => $bppbid, 's' => $s, 'c' => $c, 'hp' => $hp]);
    }

    public function pengemasan_bppb_create($bppbid, $arr)
    {
        $s = Bppb::find($bppbid);
        $larr = explode(",", $arr);
        $hp = HasilPengemasan::whereIn('id', $larr)->get();
        $c = CekPengemasan::where('detail_produk_id', $s->DetailProduk->id)->get();
        return view('page.qc.pengemasan_bppb_create', ['bppbid' => $bppbid, 's' => $s, 'c' => $c, 'hp' => $hp]);
    }

    public function pengemasan_bppb_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'hasil' => 'required',
                'tindak_lanjut' => 'required',
            ],
            [
                'hasil.required' => 'Hasil Pemeriksaan harus diisi',
                'tindak_lanjut.required' => 'Tindak Lanjut harus diisi',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            if (!empty($request->hasil_pengemasan_id)) {
                $bool = true;
                for ($i = 0; $i < count($request->hasil_pengemasan_id); $i++) {
                    $status = "";
                    if ($request->tindak_lanjut[$i] == "ok") {
                        $status = 'ok';
                    } else if ($request->tindak_lanjut[$i] == "perbaikan") {
                        $status = 'rej_pengemasan';
                    } else if ($request->tindak_lanjut[$i] == "produk_spesialis") {
                        $status = 'rej_pengemasan';
                    }

                    $h = HasilPengemasan::find($request->hasil_pengemasan_id[$i]);
                    $h->hasil = $request->hasil[$i];
                    $h->keterangan = $request->keterangan[$i];
                    $h->tindak_lanjut = $request->tindak_lanjut[$i];
                    $h->status = $status;
                    $u = $h->save();

                    if (!$u) {
                        $bool = false;
                    } else if ($u) {
                        $bool = true;
                        $c = HistoriHasilPerakitan::create([
                            "hasil_perakitan_id" => $h->hasil_perakitan_id,
                            "kegiatan" => "pemeriksaan_pengemasan",
                            "tanggal" => Carbon::now()->toDateString(),
                            "hasil" => $request->hasil[$i],
                            "keterangan" => $request->keterangan[$i],
                            "tindak_lanjut" => $request->tindak_lanjut[$i]
                        ]);
                    }
                }
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Pengemasan");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan Pengemasan");
            }
        }
    }

    public function pengemasan_bppb_edit($bppbid)
    {
        $s = Bppb::find($bppbid);
        $hp = HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppbid) {
            $q->where('bppb_id', $bppbid);
        })->get();
        $c = CekPengemasan::where('detail_produk_id', $s->DetailProduk->id)->get();
        return view('page.qc.pengemasan_bppb_edit', ['bppbid' => $bppbid, 's' => $s, 'c' => $c, 'hp' => $hp]);
    }

    public function pengemasan_bppb_update(Request $request, $id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'hasil' => 'required',
                'tindak_lanjut' => 'required',
            ],
            [
                'hasil.required' => 'Hasil Pemeriksaan harus diisi',
                'tindak_lanjut.required' => 'Tindak Lanjut harus diisi',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            if (!empty($request->hasil_pengemasan_id)) {
                $bool = true;
                for ($i = 0; $i < count($request->hasil_pengemasan_id); $i++) {
                    $status = "";
                    if ($request->tindak_lanjut[$i] == "ok") {
                        $status = 'ok';
                    } else if ($request->tindak_lanjut[$i] == "perbaikan") {
                        $status = 'rej_pengemasan';
                    } else if ($request->tindak_lanjut[$i] == "produk_spesialis") {
                        $status = 'rej_pengemasan';
                    }
                    $h = HasilPengemasan::find($request->hasil_pengemasan_id[$i]);
                    $h->hasil = $request->hasil[$i];
                    $h->keterangan = $request->keterangan[$i];
                    $h->tindak_lanjut = $request->tindak_lanjut[$i];
                    $h->status = $status;
                    $u = $h->save();


                    if (!$u) {
                        $bool = false;
                    } else if ($u) {
                        $bool = true;
                        $c = HistoriHasilPerakitan::create([
                            "hasil_perakitan_id" => $h->hasil_perakitan_id,
                            "kegiatan" => "pemeriksaan_pengemasan",
                            "tanggal" => Carbon::now()->toDateString(),
                            "hasil" => $request->hasil[$i],
                            "keterangan" => $request->keterangan[$i],
                            "tindak_lanjut" => $request->tindak_lanjut[$i]
                        ]);
                    }
                }
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Pengemasan");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan Pengemasan");
            }
        }
    }

    public function pengemasan_hasil_edit($id)
    {
        $hp = HasilPengemasan::find($id);
        return view('page.qc.pengemasan_hasil_edit', ['id' => $id, 's' => $hp]);
    }

    public function pengemasan_hasil_update(Request $request, $id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'hasil' => 'required',
                'tindak_lanjut' => 'required',
            ],
            [
                'hasil.required' => 'Hasil Pemeriksaan harus diisi',
                'tindak_lanjut.required' => 'Tindak Lanjut harus diisi',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $status = "";
            if ($request->tindak_lanjut == "ok") {
                $status = 'ok';
            } else if ($request->tindak_lanjut == "perbaikan") {
                $status = 'rej_pengemasan';
            } else if ($request->tindak_lanjut == "produk_spesialis") {
                $status = 'rej_pengemasan';
            }
            $h = HasilPengemasan::find($id);
            $h->hasil = $request->hasil;
            $h->keterangan = $request->keterangan;
            $h->tindak_lanjut = $request->tindak_lanjut;
            $h->status = $status;
            $u = $h->save();


            if (!$u) {
                return redirect()->back()->with('error', "Gagal menyimpan Pemeriksaan Pengemasan");
            } else if ($u) {
                $c = HistoriHasilPerakitan::create([
                    "hasil_perakitan_id" => $h->hasil_perakitan_id,
                    "kegiatan" => "pemeriksaan_pengemasan",
                    "tanggal" => Carbon::now()->toDateString(),
                    "hasil" => $request->hasil,
                    "keterangan" => $request->keterangan,
                    "tindak_lanjut" => $request->tindak_lanjut
                ]);

                if ($c) {
                    return redirect()->back()->with('success', "Berhasil menyimpan Pemeriksaan Pengemasan");
                }
            }
        }
    }
}
