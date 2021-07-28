<?php

namespace App\Http\Controllers;

use App\daftar_part;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;



class LabController extends Controller
{
    public function ka_internal_tambah()
    {
        return view('page.lab.ka_internal_tambah');
    }

}
