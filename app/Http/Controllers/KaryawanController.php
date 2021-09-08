<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;


class KaryawanController extends Controller
{
    public function karyawan()
    {
        return view('page.karyawan.karyawan');
    }
    public function karyawan_data()
    {
        $data = Karyawan::orderBy('nama', 'ASC');
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('x', function ($data) {
                return $data->divisi->nama;
            })
            ->addColumn('umur', function ($data) {
                $tgl  = $data->tgllahir;
                $age = Carbon::parse($tgl)->diff(Carbon::now())->y;
                return $age . " Thn";
            })
            ->make(true);
    }
}
