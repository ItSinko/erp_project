<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Divisi;
use App\Karyawan;
use App\Kesehatan_awal;
use App\Kesehatan_harian;
use Illuminate\Http\Request;
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
                $btn = '<div class="inline-flex"><button type="button" id="edit"  data-id="' . $data->id . '" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                $btn = $btn . '<a href="/kesehatan/ubah/' . $data->id . '"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-edit"></i></button></a>';
                $btn = $btn . ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->rawColumns(['button'])
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
            'tes_covid' => $request->tes_covid,
            'hasil_covid' => $request->hasil_covid,
            'file_mcu' => $request->file_mcu,
            'file_covid' => $request->file_covid,
        ]);

        if ($kesehatan_awal) {
            return redirect()->back()->with('success', "");
        } else {
            return redirect()->back()->with('error', "");
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
        $data = Karyawan::with('divisi')
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
                return $data->suhu_pagi . ' °C';
            })
            ->addColumn('siang', function ($data) {
                return $data->suhu_siang . ' °C';
            })
            ->addColumn('sp', function ($data) {
                return $data->spo2 . ' %';
            })
            ->addColumn('prx', function ($data) {
                return $data->pr . ' bpm';
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
}
