<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

use App\Jasa_eks;
use App\Distributor;

class CommonController extends Controller
{
    public function jasa_eks()
    {
        return view('page.common.jasa_eks');
    }

    public function nama_alamat()
    {
        return view('page.common.nama_alamat');
    }

    public function jasa_eks_data()
    {
        $data = Jasa_eks::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function nama_alamat_data()
    {
        $data = Distributor::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
