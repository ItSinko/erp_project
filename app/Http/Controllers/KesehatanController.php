<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Divisi;
use App\gcu_karyawan;
use App\Karyawan;
use App\karyawan_sakit;
use App\Kesehatan_awal;
use App\Kesehatan_harian;
use App\kesehatan_mingguan_rapid;
use App\kesehatan_mingguan_tensi;
use App\obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

class KesehatanController extends Controller
{
    public function kesehatan_harian()
    {
        return view('page.kesehatan.kesehatan_harian');
    }
    public function kesehatan()
    {
        return view('page.kesehatan.kesehatan');
    }
    public function kesehatan_data_detail($karyawan_id)
    {
        $data = Kesehatan_awal::with('karyawan')
            ->where('karyawan_id', $karyawan_id)->get();
        echo json_encode($data);
    }
    public function kesehatan_detail()
    {
        $karyawan = Karyawan::all();
        return view('page.kesehatan.kesehatan_detail', ['karyawan' => $karyawan]);
    }
    public function kesehatan_data()
    {
        $data = Kesehatan_awal::with('karyawan');
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('berat_kg', function ($data) {
                return $data->berat . ' Kg';
            })
            ->addColumn('tinggi_cm', function ($data) {
                return $data->tinggi . ' Cm';
            })
            ->addColumn('bmi', function ($data) {
                return $data->berat / (($data->tinggi / 100) * ($data->tinggi / 100));
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><a href="/kesehatan/ubah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></a>';
                $btn = $btn . ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button', 'berat_kg'])
            ->make(true);
    }
    public function kesehatan_tambah()
    {
        $karyawan = Karyawan::all();
        return view('page.kesehatan.kesehatan_tambah', ['karyawan' => $karyawan]);
    }
    public function kesehatan_ubah($id)
    {
        $karyawan = Karyawan::all();
        $kesehatan_awal = Kesehatan_awal::find($id);
        return view('page.kesehatan.kesehatan_ubah', ['karyawan' => $karyawan, 'kesehatan_awal' => $kesehatan_awal]);
    }

    public function kesehatan_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'karyawan_id' => 'required|unique:kesehatan_awals',
                'status_vaksin' => 'required',
                'tinggi' => 'required',
                'berat' => 'required',
                'status_mata' => 'required'
            ],
            [
                'karyawan_id.required' => 'Karyawan harus di pilih',
                'karyawan_id.unique' => 'Karyawan sudah pernah di input',
                'status_vaksin.required' => 'Status Vaksin harus di pilih',
                'tinggi.required' => 'Tinggi harus di isi',
                'berat.required' => 'Berat harus di isi',
                'status_mata.required' => 'Kategori buta warna harus di isi'
            ]
        );



        //Upload
        if ($request->hasFile('file_mcu')) {
            $karyawan = Karyawan::find($request->karyawan_id);
            $file = $request->file('file_mcu')->getClientOriginalName();
            $path = $request->file('file_mcu')->move(base_path('\public\file\kesehatan'), $karyawan->nama . '_MCU_' . $file);
            $file_mcu = $karyawan->nama . '_MCU_' . $file;
        } else {
            $file_mcu = NULL;
        }

        //Upload
        if ($request->hasFile('file_covid')) {
            $karyawan = Karyawan::find($request->karyawan_id);
            $file = $request->file('file_covid')->getClientOriginalName();
            $path = $request->file('file_covid')->move(base_path('\public\file\kesehatan'), $karyawan->nama . '_COVID_' . $file);
            $file_covid = $karyawan->nama . '_COVID_' . $file;
        } else {
            $file_covid = NULL;
        }

        $kesehatan_awal = Kesehatan_awal::create([
            'karyawan_id' => $request->karyawan_id,
            'vaksin' => $request->status_vaksin,
            'ket_vaksin' => $request->ket_vaksin,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'lemak' => $request->lemak,
            'kandungan_air' => $request->kandungan_air,
            'otot' => $request->otot,
            'tulang' => $request->tulang,
            'kalori' => $request->kalori,
            'status_mata' => $request->status_mata,
            'mata_kiri' => $request->mata_kiri,
            'mata_kanan' => $request->mata_kanan,
            'tes_covid' => $request->tes_covid,
            'hasil_covid' => $request->hasil_covid,
            'file_mcu' => $file_mcu,
            'file_covid' => $file_covid,
        ]);



        if ($kesehatan_awal) {
            return redirect()->back()->with('success', "Berhasil menambahkan data");
        } else {
            return redirect()->back()->with('error', "Gagal menambahkan data");
        }
    }

    public function kesehatan_harian_tambah()
    {

        $data = Karyawan::with('divisi')
            ->get();
        $divisi = Divisi::all();
        return view('page.kesehatan.kesehatan_harian_tambah', ['data' => $data, 'divisi' => $divisi]);
    }

    public function kesehatan_harian_tambah_data($id)
    {
        $data = Karyawan::with('divisi', 'kesehatan_awal')
            ->where('divisi_id', $id)->get();
        echo json_encode($data);
    }

    public function kesehatan_harian_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'divisi' => 'required',
                'tgl' => 'required',
            ],
            [
                'divisi.required' => 'Divisi harus di pilih',
                'tgl.required' => 'Tanggal pengecekan harus dipilih',
            ]
        );

        for ($i = 0; $i < count($request->karyawan_id); $i++) {
            $kesehatan_harian = Kesehatan_harian::create([
                'tgl_cek' => $request->tgl,
                'karyawan_id' => $request->karyawan_id[$i],
                'suhu_siang' => $request->suhu_siang[$i],
                'suhu_pagi' => $request->suhu_pagi[$i],
                'spo2' => $request->spo2[$i],
                'pr' => $request->pr[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }

        if ($kesehatan_harian) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
    public function kesehatan_harian_data()
    {
        $data = Kesehatan_harian::with('karyawan')
            ->orderBy('tgl_cek', 'DESC');

        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('pagi', function ($data) {
                if ($data->suhu_pagi != NULL) {
                    return $data->suhu_pagi;
                } else {
                    return '0 %';
                }
            })
            ->addColumn('siang', function ($data) {
                if ($data->suhu_siang != NULL) {
                    return $data->suhu_siang;
                } else {
                    return '0 %';
                }
            })
            ->addColumn('sp', function ($data) {
                if ($data->spo2 != NULL) {
                    return $data->spo2;
                } else {
                    return '0 %';
                }
            })
            ->addColumn('prx', function ($data) {
                if ($data->pr != NULL) {
                    return $data->pr;
                } else {
                    return '0 %';
                }
            })
            ->addColumn('button', function ($data) {

                $btn = '<div class="inline-flex"><button type="button" id="edit" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></div>';
                $btn = $btn . ' <div class="inline-flex"><button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function kesehatan_harian_detail()
    {
        // // $kesehatan_harian_tgl = Kesehatan_harian::orderby('tgl_cek')->pluck('tgl_cek');
        // // $kesehatan_harian_pagi = Kesehatan_harian::orderby('tgl_cek')->pluck('suhu_pagi');
        // // $kesehatan_harian_siang = Kesehatan_harian::orderby('tgl_cek')->pluck('suhu_siang');
        // // $chart = new SampleChart;
        // $chart->labels($kesehatan_harian_tgl->values());
        // $chart->dataset('Pagi', 'line', $kesehatan_harian_pagi->values())->color('red')->backgroundColor('transparent');
        // $chart->dataset('Siang', 'line', $kesehatan_harian_siang->values())->color('blue')->backgroundColor('transparent');
        $karyawan = Karyawan::all();
        return view('page.kesehatan.kesehatan_harian_detail', ['karyawan' => $karyawan]);
    }

    public function kesehatan_harian_detail_data($id)
    {
        $data = Kesehatan_harian::with('karyawan')
            ->orderBy('tgl_cek', 'DESC')
            ->where('karyawan_id', $id);

        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('pagi', function ($data) {
                return $data->suhu_pagi . ' °C';
            })
            ->addColumn('siang', function ($data) {
                return $data->suhu_siang . ' °C';
            })
            ->addColumn('sp', function ($data) {
                return $data->spo2 . ' %';
            })
            ->addColumn('pr', function ($data) {
                return $data->pr . ' bpm';
            })
            ->make(true);
    }
    public function kesehatan_harian_detail_data_karyawan($id)
    {
        $data = Kesehatan_harian::where('karyawan_id', $id)->get();
        $tgl = $data->pluck('tgl_cek');
        $labels2 = $data->pluck('suhu_pagi');
        $labels3 = $data->pluck('suhu_siang');
        $labels4 = $data->pluck('spo2');
        $labels5 = $data->pluck('pr');
        return response()->json(compact('tgl', 'data', 'labels2', 'labels3', 'labels4', 'labels5'));
        //echo json_encode($data, $labels);
    }
    public function kesehatan_harian_aksi_ubah(Request $request)
    {
        $id = $request->id;
        $kesehatan_harian = Kesehatan_harian::find($id);
        $kesehatan_harian->suhu_pagi = $request->suhu_pagi;
        $kesehatan_harian->suhu_siang = $request->suhu_siang;
        $kesehatan_harian->spo2 = $request->spo2;
        $kesehatan_harian->pr = $request->pr;
        $kesehatan_harian->save();

        if ($kesehatan_harian) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
    public function kesehatan_mingguan()
    {
        return view('page.kesehatan.kesehatan_mingguan');
    }
    public function kesehatan_mingguan_tambah()
    {
        $divisi = Divisi::all();
        return view('page.kesehatan.kesehatan_mingguan_tambah', ['divisi' => $divisi]);
    }
    public function kesehatan_mingguan_tensi_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'divisi' => 'required',
                'tgl_cek' => 'required',
            ],
            [
                'divisi.required' => 'Divisi harus di pilih',
                'tgl_cek.required' => 'Tanggal pengecekan harus dipilih',
            ]
        );

        for ($i = 0; $i < count($request->karyawan_id); $i++) {
            $kesehatan_mingguan_tensi = kesehatan_mingguan_tensi::create([
                'karyawan_id' => $request->karyawan_id[$i],
                'tgl_cek' => $request->tgl_cek,
                'sistolik' => $request->sistolik[$i],
                'diastolik' => $request->diastolik[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }

        if ($kesehatan_mingguan_tensi) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
    public function kesehatan_mingguan_rapid_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'divisi' => 'required',
                'tgl_cek' => 'required',
            ],
            [
                'divisi.required' => 'Divisi harus di pilih',
                'tgl_cek.required' => 'Tanggal pengecekan harus dipilih',
            ]
        );
        for ($i = 0; $i < count($request->karyawan_id); $i++) {
            $kesehatan_mingguan_rapid = kesehatan_mingguan_rapid::create([
                'karyawan_id' => $request->karyawan_id[$i],
                'tgl_cek' => $request->tgl_cek,
                'hasil' => $request->hasil[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }

        if ($kesehatan_mingguan_rapid) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }


    public function kesehatan_mingguan_tensi_data()
    {
        $data = kesehatan_mingguan_tensi::with('karyawan')
            ->orderBy('tgl_cek', 'DESC');

        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('sis', function ($data) {
                return $data->sistolik . ' mmHg';
            })
            ->addColumn('dias', function ($data) {
                return $data->diastolik . ' mmHg';
            })
            ->addColumn('button', function ($data) {

                $btn = '<div class="inline-flex"><button type="button" id="edit_tensi" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></div>';
                $btn = $btn . ' <div class="inline-flex"><button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function kesehatan_mingguan_rapid_data()
    {
        $data = kesehatan_mingguan_rapid::with('karyawan')
            ->orderBy('tgl_cek', 'DESC');

        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="edit_rapid"  class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></div>';
                $btn = $btn . ' <div class="inline-flex"><button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function kesehatan_mingguan_detail()
    {
        $karyawan = Karyawan::all();
        return view('page.kesehatan.kesehatan_mingguan_detail', ['karyawan' => $karyawan]);
    }


    public function kesehatan_mingguan_tensi_detail_data($karyawan_id)
    {
        $data = kesehatan_mingguan_tensi::where('karyawan_id', $karyawan_id);
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sis', function ($data) {
                return $data->sistolik . ' mmHg';
            })
            ->addColumn('dias', function ($data) {
                return $data->diastolik . ' mmHg';
            })
            ->make(true);
    }
    public function kesehatan_mingguan_rapid_detail_data($karyawan_id)
    {
        $data = kesehatan_mingguan_rapid::where('karyawan_id', $karyawan_id);
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }


    public function kesehatan_mingguan_tensi_detail_data_karyawan($karyawan_id)
    {
        $data = kesehatan_mingguan_tensi::where('karyawan_id', $karyawan_id)->get();
        $data2 = kesehatan_mingguan_rapid::where([['hasil', 'Non Reaktif'], ['karyawan_id', $karyawan_id]])->count();
        $data3 = kesehatan_mingguan_rapid::where([['hasil', 'IgG'], ['karyawan_id', $karyawan_id]])->count();
        $data4 = kesehatan_mingguan_rapid::where([['hasil', 'IgM'], ['karyawan_id', $karyawan_id]])->count();
        $data5 = kesehatan_mingguan_rapid::where([['hasil', 'IgG-IgM '], ['karyawan_id', $karyawan_id]])->count();
        $tgl = $data->pluck('tgl_cek');
        $labels2 = $data->pluck('sistolik');
        $labels3 = $data->pluck('diastolik');
        return response()->json(compact('tgl', 'labels2', 'labels3', 'data2', 'data3', 'data4', 'data5'));
    }

    public function kesehatan_bulanan_tambah()
    {
        $divisi = Divisi::all();
        return view('page.kesehatan.kesehatan_bulanan_tambah', ['divisi' => $divisi]);
    }
    public function kesehatan_bulanan()
    {
        return view('page.kesehatan.kesehatan_bulanan');
    }
    public function kesehatan_mingguan_tensi_aksi_ubah(Request $request)
    {
        $id = $request->id;
        $kesehatan_mingguan_tensi = kesehatan_mingguan_tensi::find($id);
        $kesehatan_mingguan_tensi->sistolik = $request->sistolik;
        $kesehatan_mingguan_tensi->diastolik = $request->diastolik;
        $kesehatan_mingguan_tensi->keterangan = $request->catatan;
        $kesehatan_mingguan_tensi->save();

        if ($kesehatan_mingguan_tensi) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function kesehatan_mingguan_rapid_aksi_ubah(Request $request)
    {
        $id = $request->id;
        $kesehatan_mingguan_rapid = kesehatan_mingguan_rapid::find($id);
        $kesehatan_mingguan_rapid->hasil = $request->hasil;
        $kesehatan_mingguan_rapid->keterangan = $request->catatan;
        $kesehatan_mingguan_rapid->save();

        if ($kesehatan_mingguan_rapid) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function kesehatan_bulanan_gcu_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'divisi' => 'required',
                'tgl_cek' => 'required',
            ],
            [
                'divisi.required' => 'Divisi harus di pilih',
                'tgl_cek.required' => 'Tanggal pengecekan harus dipilih',
            ]
        );

        for ($i = 0; $i < count($request->karyawan_id); $i++) {
            $gcu_karyawan = gcu_karyawan::create([
                'karyawan_id' => $request->karyawan_id[$i],
                'tgl_cek' => $request->tgl_cek,
                'glukosa' => $request->glukosa[$i],
                'kolesterol' => $request->kolesterol[$i],
                'asam_urat' => $request->asam_urat[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }

        if ($gcu_karyawan) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function kesehatan_bulanan_gcu_data()
    {
        $data = gcu_karyawan::with('karyawan')
            ->orderBy('tgl_cek', 'DESC');

        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('glu', function ($data) {
                if ($data->glukosa != NULL) {
                    return $data->glukosa;
                } else {
                    return '0 %';
                }
            })

            ->addColumn('kol', function ($data) {
                if ($data->kolesterol != NULL) {
                    return $data->kolesterol;
                } else {
                    return '0 %';
                }
            })

            ->addColumn('asam', function ($data) {
                if ($data->asam_urat != NULL) {
                    return $data->asam_urat;
                } else {
                    return '0 %';
                }
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="edit_gcu"  class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></div>';
                $btn = $btn . ' <div class="inline-flex"><button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function kesehatan_bulanan_gcu_aksi_ubah(Request $request)
    {
        $id = $request->id;
        $gcu_karyawan = gcu_karyawan::find($id);
        $gcu_karyawan->glukosa = $request->glukosa;
        $gcu_karyawan->kolesterol = $request->kolesterol;
        $gcu_karyawan->asam_urat = $request->asam_urat;
        $gcu_karyawan->keterangan = $request->catatan;
        $gcu_karyawan->save();

        if ($gcu_karyawan) {
            return redirect()->back()->with('success', 'Data berhasil di ubah');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
    public function kesehatan_bulanan_gcu_detail()
    {
        $karyawan = Karyawan::all();
        return view('page.kesehatan.kesehatan_bulanan_detail', ['karyawan' => $karyawan]);
    }

    public function kesehatan_bulanan_gcu_detail_data($karyawan_id)
    {
        $data = gcu_karyawan::where('karyawan_id', $karyawan_id);
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('glu', function ($data) {
                if ($data->glukosa != NULL) {
                    return $data->glukosa;
                } else {
                    return '0 %';
                }
            })

            ->addColumn('kol', function ($data) {
                if ($data->kolesterol != NULL) {
                    return $data->kolesterol;
                } else {
                    return '0 %';
                }
            })

            ->addColumn('asam', function ($data) {
                if ($data->asam_urat != NULL) {
                    return $data->asam_urat;
                } else {
                    return '0 %';
                }
            })
            ->make(true);
    }
    public function kesehatan_bulanan_detail_data_karyawan($karyawan_id)
    {
        $data = gcu_karyawan::where('karyawan_id', $karyawan_id)->get();
        $tgl = $data->pluck('tgl_cek');
        $labels2 = $data->pluck('glukosa');
        $labels3 = $data->pluck('kolesterol');
        $labels4 = $data->pluck('asam_urat');
        return response()->json(compact('tgl', 'labels2', 'labels3', 'labels4'));
    }

    public function karyawan_sakit()
    {
        return view('page.kesehatan.karyawan_sakit');
    }
    public function karyawan_sakit_tambah()
    {
        $karyawan = Karyawan::all();
        $obat = Obat::all();
        $pengecek = $karyawan->where('divisi_id', '28');
        return view('page.kesehatan.karyawan_sakit_tambah', ['karyawan' => $karyawan, 'pengecek' => $pengecek, 'obat' => $obat]);
    }
    // public function obat_data()
    // {
    //     $data = Obat::all();
    //     echo json_encode($data);
    // }

    public function karyawan_sakit_aksi_tambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'karyawan_id' => 'required',
                'tgl' => 'required',
                'pemeriksa_id' => 'required',
            ],
            [
                'pemeriksa_id.required' => 'Pemeriksa harus di pilih',
                'karyawan_id.required' => 'Karyawan harus di pilih',
                'tgl.required' => 'Tanggal pengecekan harus di isi',
            ]
        );
        $karyawan_sakit = Karyawan_sakit::create([
            'tgl_cek' => $request->tgl,
            'karyawan_id' => $request->karyawan_id,
            'pemeriksa_id' => $request->pemeriksa_id,
            'analisa' => $request->analisa,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->hasil_1,
            'terapi' => $request->terapi,
            'obat_id' => $request->obat_id,
            'aturan' => $request->aturan_obat,
            'konsumsi' => $request->dosis_obat,
            'keputusan' => $request->hasil_2
        ]);
        if ($karyawan_sakit) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function karyawan_sakit_data()
    {
        $data = Karyawan_sakit::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->karyawan->divisi->nama;
            })
            ->addColumn('y', function ($data) {
                return $data->karyawan->nama;
            })
            ->addColumn('z', function ($data) {
                return $data->pemeriksa->nama;
            })
            ->addColumn('o', function ($data) {
                if ($data->obat_id != NULL) {
                    return $data->obat->nama;
                } else {
                    return '';
                }
            })
            ->addColumn('d', function ($data) {
                if ($data->obat_id != NULL) {
                    return $data->aturan;
                } else {
                    return '';
                }
            })
            ->addColumn('e', function ($data) {
                if ($data->obat_id != NULL) {
                    return $data->konsumsi;
                } else {
                    return '';
                }
            })

            ->addColumn('detail_button', function ($data) {
                $btn = $data->tindakan;
                $btn = $btn . '<br><div class="inline-flex"><button type="button" id="detail_tindakan"  class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-eye"></i></button></div>';
                return  $btn;
            })
            ->addColumn('button', function ($data) {
                $btn = '<div class="inline-flex"><button type="button" id="edit_gcu"  class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fa fa-eye" aria-hidden="true"></i></button></div>';
                $btn = $btn . ' <div class="inline-flex"><button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button', 'detail_button'])
            ->make(true);
    }
}
