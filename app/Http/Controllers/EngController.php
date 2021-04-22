<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Produk;
use App\DokumenEng;

class EngController extends Controller
{
    public function upload()
    {
        $data = Produk::select('nama')->get();
        $dokumen = DokumenEng::all();
        Storage::disk('local')->put('example.txt', 'Contents');
        return view('page.engineering.upload', ['data' => $data, 'dokumen' => $dokumen]);
    }

    public function upload_file(Request $request)
    {
        return redirect()->back()->with('message', json_encode($request));
    }

    public function test()
    {
        return Produk::all();
    }
}
