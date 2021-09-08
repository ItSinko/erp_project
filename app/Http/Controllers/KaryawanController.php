<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function karyawan()
    {
        return view('page.karyawan.karyawan');
    }
}
